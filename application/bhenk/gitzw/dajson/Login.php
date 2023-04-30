<?php

namespace bhenk\gitzw\dajson;

use DateTime;
use Exception;
use JsonSerializable;
use function array_key_last;
use function array_keys;
use function array_slice;
use function count;
use function date;
use function intval;

class Login implements JsonSerializable {

    function __construct(private readonly string $ip, private array $data) {}

    /**
     * @return string
     */
    public function getIp(): string {
        return $this->ip;
    }

    /**
     * Add a login attempt
     * @param string $date
     * @param bool $success
     * @return void
     */
    public function addLoginAttempt(string $date, bool $success): void {
        $this->data[$date] = $success;
    }

    /**
     * Get the last time a login attempt was performed from this IP address
     * @return bool|DateTime
     * @throws Exception
     */
    public function getLastLoginDate(): bool|DateTime {
        if (empty($this->data)) return false;
        $keys = array_keys($this->data);
        return new DateTime(date($keys[array_key_last($keys)]));
    }

    /**
     * Is a login attempt allowed from the IP address registered by this class
     *
     * Login attempts are allowed if:
     *
     * * no more than 3 attempts have been done,
     * * at least one of last 3 attempts were successful
     * * all last 3 attempts were failure, but the time between last attempt and this attempt is more or equal
     *    to 3 hours
     *
     * @param string $date
     * @return bool
     * @throws Exception
     */
    public function canLogin(string $date): bool {
        if (count($this->data) < 3) return true;
        $last3 = array_slice($this->data, -3);
        foreach ($last3 as $key => $success) {
            if ($success) return true;
        }
        // none of last 3 attempts were success
        $last = $this->getLastLoginDate();
        $now = new DateTime(date($date));
        $diff = $last->diff($now);
        $days = intval($diff->format("%R%a"));
        $hours = intval($diff->format("%R%h")) + $days * 24;
        if ($hours >= 3) return true;
        return false;
    }

    public function jsonSerialize(): array {
        return $this->data;
    }
}