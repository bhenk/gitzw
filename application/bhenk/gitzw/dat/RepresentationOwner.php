<?php

namespace bhenk\gitzw\dat;

use bhenk\msdata\abc\Join;
use Exception;
use function array_keys;
use function in_array;
use function is_null;
use function uasort;

/**
 * Administers related Representations
 */
abstract class RepresentationOwner {
    use RulesTrait;

    /** @var array<int, Representation>|null */
    private ?array $representations = null;

    /**
     * Get the ID of the StoredObject that owns the Representations
     *
     * @return string|null ID of owner
     */
    public abstract function getOwnerID(): ?string;

    /**
     * Remove a Representation from this owner
     *
     * @param Representation $representation Representation ID (int), Representation REPID (string)
     *   or Representation (object)
     * @return bool *true* if Representation successfully removed, *false* otherwise
     * @throws Exception
     */
    protected function removeRepresentation(Representation $representation): bool {
        $this->doRemoveRepr($representation);
        $repRelations = $this->getRepRelations();
        if (in_array($representation->getID(), array_keys($repRelations))) {
            $repRelations[$representation->getID()]->setDeleted(true);
        }
        $representation->getRelations()->resetRelations();
        return true;
    }

    /**
     * Lazily fetch the related Representations
     *
     * @return array|Representation[] owned Representations, array with Representation ID as key
     * @throws Exception
     */
    public function getRepresentations(): array {
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
     * @return array<int, Join> Join DataObjects, array with Representation ID as key
     */
    public abstract function getRepRelations(): array;

    /**
     * Get the Representation with the given Representation ID
     *
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

}