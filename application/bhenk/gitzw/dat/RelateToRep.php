<?php

namespace bhenk\gitzw\dat;

use bhenk\msdata\abc\Join;
use Exception;
use function array_keys;
use function in_array;
use function is_null;

/**
 * Administers related Representations
 */
abstract class RelateToRep {
    use RulesTrait;

    /** @var array<int, Representation>|null */
    private ?array $representations = null;

    /**
     * Remove a Representation from this owner
     * @param int|string|Representation $representation Representation ID (int), Representation REPID (string)
     *   or Representation (object)
     * @return bool *true* if Representation successfully removed, *false* otherwise
     * @throws Exception
     */
    public function removeRepresentation(int|string|Representation $representation): bool {
        $this->resetMessages();
        $representation = $this->applyRemoveRule($representation);
        if (!$representation) return false;
        if (!$this->removeAllowed($representation)) return false;
        ////
        $this->doRemoveRepr($representation);
        $repRelations = $this->getRepRelations();
        if (in_array($representation->getID(), array_keys($repRelations))) {
            $repRelations[$representation->getID()]->setDeleted(true);
        }
        $representation->getRelations()->resetRelations();
        return true;
    }

    /**
     * Check if Representation can be removed
     *
     * * Representation must exist and be persisted
     * * Representation must be related
     *
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function applyRemoveRule(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (!in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID() . " not related");
            return false;
        }
        return $representation;
    }

    /**
     * Lazily fetch the related Representations
     * @return array|Representation[]|null
     * @throws Exception
     */
    public function getRepresentations(): ?array {
        if (is_null($this->representations)) {
            $this->representations = [];
            $repRelations = $this->getRepRelations();
            if (!empty($repRelations)) {
                $this->representations = Store::representationStore()->selectBatch(array_keys($repRelations));
            }
        }
        return $this->representations;
    }

    /**
     * Get the Join objects
     *
     * @return array<int, Join> array with Representation ID as key
     */
    public abstract function getRepRelations(): array;

    /**
     * Give subclasses a last chance to prevent removal of a Representation
     * @param Representation $representation Representation to remove
     * @return bool *true* if allowed, *false* otherwise
     */
    public abstract function removeAllowed(Representation $representation): bool;

    /**
     * Actually remove the Representation without checks
     * @param Representation $repr
     * @return void
     * @throws Exception
     */
    protected function doRemoveRepr(Representation $repr): void {
        $this->getRepresentations();
        unset($this->representations[$repr->getID()]);
    }

    /**
     * Get the Representation with the given Representation ID
     * @param int $representationID ID of the Representation
     * @return Representation|null Representation or *null* if Representation not related
     * @throws Exception
     */
    public function getRepresentation(int $representationID): ?Representation {
        $representations = $this->getRepresentations();
        if (in_array($representationID, array_keys($representations))) return $representations[$representationID];
        return null;
    }

    /**
     * Check if Representation can be added
     *
     * * Representation must exist and be persisted
     * * Representation must not be related yet
     *
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function applyAddRule(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID() . " already related");
            return false;
        }
        return $representation;
    }

    /**
     * Actually add the Representation without checks
     * @param Representation $repr
     * @return void
     * @throws Exception
     */
    protected function doAddRepr(Representation $repr): void {
        $repr->getRelations()->resetRelations();
        $this->getRepresentations();
        $this->representations[$repr->getID()] = $repr;
    }

}