<?php

namespace bhenk\gitzw\model;

use function session_start;
use function session_status;
use function session_write_close;

class ProgressListener {

    const PREFIX_TOTAL = "total_";
    const PREFIX_PROGRESS = "progress_";
    const PREFIX_MSG = "msg_";

    private int $progress = 0;

    function __construct(private readonly string $id,
                         private int             $total,
                         private int             $updateFrequency = 1) {
        if ($this->total < 1) $this->total = 1;
        if ($this->updateFrequency < 1) $this->updateFrequency = 1;
        $this->updateStatus([self::PREFIX_TOTAL . $this->id => $this->total]);
    }

    public function updateStatus(array $args): void {
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        foreach ($args as $key => $value) {
            $_SESSION[$key] = $value;
        }
        session_write_close();
    }

    public function updateMessage(string $message): void {
        $this->updateStatus([self::PREFIX_MSG . $this->id => $message]);
    }

    public function increase(): int {
        $this->progress++;
        if (($this->progress % $this->updateFrequency) == 0) {
            $this->updateStatus([self::PREFIX_PROGRESS . $this->id => $this->progress]);
        }
        return $this->progress;
    }

    public function getProgress(): int {
        return $this->progress;
    }

}