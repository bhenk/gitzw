<?php

namespace bhenk\gitzw\model;

use DateTimeImmutable;
use function substr;

trait DateTrait {

    private DateInterface $date;

    public function initDateTrait(DateInterface $dateObject): void {
        $this->date = $dateObject;
    }

    /**
     * Get the creation date
     *
     * Gets the creation date in the original format. If no creation date was set will return
     * the empty string.
     *
     * @return string date in original format or empty string
     */
    public function getDate(): string {
        if ($this->date->getDate()) {
            $format = $this->date->getDateFormat() ?? "Y";
            $dt = DateTimeImmutable::createFromFormat("Y-m-d", $this->date->getDate());
            return $dt->format($format);
        }
        return "";
    }

    /**
     * Sets the db-value to Y-m-d and the dateFormat to what is found in the parameter; for valid date strings.
     * @param string $date
     * @return bool
     */
    public function setDate(string $date): bool {
        list($dt, $format) = DateUtil::validate($date);
        /** @var DateTimeImmutable|bool $dt */
        if ($dt) {
            $this->date->setDate($dt->format("Y-m-d"));
            $this->date->setDateFormat($format);
            return true;
        }
        return false;
    }

    public function getYear(): ?string {
        if ($this->date->getDate()) {
            return substr($this->date->getDate(), 0, 4);
        }
        return null;
    }

}