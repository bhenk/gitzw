<?php

namespace bhenk\gitzw\dat;

use Exception;
use function array_key_last;
use function array_keys;
use function count;
use function implode;
use function in_array;
use function is_null;

trait RulesTrait {

    private array $messages = [];

    /**
     * Get the last message or false if no message
     * @return string|bool
     */
    public function getLastMessage(): string|bool {
        return empty($this->messages) ? false : $this->messages[array_key_last($this->messages)];
    }

    /**
     * @return string[]
     */
    public function getMessages(): array {
        return $this->messages;
    }

    public function getMessagesAsString(): string {
        return empty($this->messages) ? "" : "* " . implode(PHP_EOL . "* ", $this->messages);
    }

    /**
     * @param string $message
     * @return void
     */
    protected function addMessage(string $message): void {
        $this->messages[] = $message;
    }

    protected function resetMessages(): void {
        $this->messages = [];
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function exhibitionCanAddRepresentation(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID()
                . " already related to Exhibition:" . $this->getOwnerID());
            return false;
        }
        if (empty($representation->getRelations()->getWorks())) {
            $this->addMessage("Representation:" . $representation->getID()
                . " not related to a Work and cannot be added to Exhibition:" . $this->getOwnerID());
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function workCanAddRepresentation(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID()
                . " already related to Work:" . $this->getOwnerID());
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function exhibitionCanRemoveRepresentation(int|string|Representation $representation
    ): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (!in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID()
                . " not related to Exhibition:" . $this->getOwnerID());
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    protected function workCanRemoveRepresentation(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $representations = $this->getRepresentations();
        if (!in_array($representation->getID(), array_keys($representations))) {
            $this->addMessage("Representation:" . $representation->getID()
                . " not related to Work:" . $this->getOwnerID());
            return false;
        }
        if (count($representations) == 1) {
            $this->addMessage("Representation:" . $representation->getID()
            . " cannot be removed. Last Representation of Work:" . $this->getOwnerID());
            return false;
        }
        $exhHasReps = $representation->getRelations()->getExhibitionRelations();
        if (!empty($exhHasReps)) {
            $this->addMessage("Representation:" . $representation->getID()
                . " has " . count($exhHasReps) . " Exhibitions and cannot be removed");
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    private function representationCanBeDeleted(int|string|Representation $representation): bool|Representation {
        $representation = $this->representationMustExist($representation);
        if (!$representation) return false;
        $workHasReps = $representation->getRelations()->getWorkRelations();
        if (!empty($workHasReps)) {
            $this->addMessage("Representation:" . $representation->getID()
                . " is owned by " . count($workHasReps) . " Works and cannot be deleted");
            return false;
        }
        $exhHasReps = $representation->getRelations()->getExhibitionRelations();
        if (!empty($exhHasReps)) {
            $this->addMessage("Representation:" . $representation->getID()
                . " is owned by " . count($exhHasReps) . " Exhibitions and cannot be deleted");
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Representation $representation
     * @return bool|Representation
     * @throws Exception
     */
    private function representationMustExist(int|string|Representation $representation): bool|Representation {
        $representation = Store::representationStore()->get($representation);
        if (!$representation) {
            $this->addMessage("Representation not found");
            return false;
        }
        if (is_null($representation->getID())) {
            $this->addMessage("Representation not persistent");
            return false;
        }
        return $representation;
    }

    /**
     * @param int|string|Creator $creator
     * @return bool|Creator
     * @throws Exception
     */
    private function creatorCanBeDeleted(int|string|Creator $creator): bool|Creator {
        $creator = $this->creatorMustExist($creator);
        if (!$creator) return false;
        $works = $creator->getWorks();
        if (!empty($works)) {
            $this->addMessage("Creator:" . $creator->getID()
                . " has " . count($works) . " Works and cannot be deleted");
            return false;
        }
        return $creator;
    }

    /**
     * @param int|string|Creator $creator
     * @return bool|Creator
     * @throws Exception
     */
    private function creatorMustExist(int|string|Creator $creator): bool|Creator {
        $creator = Store::creatorStore()->get($creator);
        if (!$creator) {
            $this->addMessage("Creator not found");
            return false;
        }
        if (is_null($creator->getID())) {
            $this->addMessage("Creator not persistent");
            return false;
        }
        return $creator;
    }

    /**
     * @param int|string|Work $work
     * @return bool|Work
     * @throws Exception
     */
    private function workCanBeDeleted(int|string|Work $work): bool|Work {
        $work = $this->workMustExist($work);
        if (!$work) return false;
        $representations = $work->getRelations()->getRepresentations();
        $exhibits = 0;
        foreach ($representations as $representation) {
            $exhibitions = $representation->getRelations()->getExhibitions();
            foreach ($exhibitions as $exhibition) {
                $exhibits++;
                $this->addMessage("Work:" . $work->getID() . " has Representation:" . $representation->getID()
                    . ", that has Exhibition:" . $exhibition->getID() . " and cannot be deleted");
            }
        }
        if ($exhibits != 0) {
            $this->addMessage("Work:" . $work->getID() . " has " . $exhibits . " Exhibition and cannot be deleted");
            return false;
        }
        return $work;
    }

    private function workMustExist(int|string|Work $work): bool|Work {
        $work = Store::workStore()->get($work);
        if (!$work) {
            $this->addMessage("Work not found");
            return false;
        }
        if (is_null($work->getID())) {
            $this->addMessage("Work not persistent");
            return false;
        }
        return $work;
    }

}