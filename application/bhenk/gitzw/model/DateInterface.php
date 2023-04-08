<?php

namespace bhenk\gitzw\model;

interface DateInterface {

    public function getDate(): ?string;

    public function setDate(string $date): void;

    public function getDateFormat(): ?string;

    public function setDateFormat(?string $d_format): void;

}