<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\model\PersonTrait;

class Creator extends AbstractStoredObject {
    use PersonTrait;

    function __construct(private readonly CreatorDo $creatorDo = new CreatorDo()) {
        $this->initPersonTrait($this->creatorDo);
    }

    public function getID(): ?int {
        return $this->creatorDo->getID();
    }

    /**
     * @return CreatorDo
     */
    public function getCreatorDo(): CreatorDo {
        return $this->creatorDo;
    }


}