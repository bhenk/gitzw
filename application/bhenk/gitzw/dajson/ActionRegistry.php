<?php

namespace bhenk\gitzw\dajson;

use bhenk\gitzw\base\Env;
use function array_keys;
use function file_get_contents;
use function file_put_contents;
use function in_array;
use function is_null;
use function json_decode;
use function json_encode;

class ActionRegistry {

    /** @var Action[] $actions */
    private array $actions = [];

    function  __construct() {
        $actionData = $this->load();
        foreach ($actionData["actions"] as $acid => $data) {
            $action = new Action($acid, $data);
            $this->actions[$acid] = $action;
        }
    }

    private function getFilename(): string {
        return Env::dataDir() . DIRECTORY_SEPARATOR . "auth" . DIRECTORY_SEPARATOR . "actions.json";
    }

    private function load(): array {
        $data = json_decode(file_get_contents($this->getFilename()), true);
        if (is_null($data)) return [];
        return $data;
    }

    public function serialize(): string {
        return json_encode(["actions" => $this->actions], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function getActionByAcid(string $acid): Action|bool {
        return $this->actions[$acid] ?? false;
    }

    public function getActionsByPath(string $path): array {
        $result = [];
        foreach ($this->actions as $action) {
            if ($action->getPath() == $path) $result[$action->getACID()] = $action;
        }
        return $result;
    }

    public function getActions(): array {
        return $this->actions;
    }

    public function addAction(Action $action): void {
        $this->actions[$action->getACID()] = $action;
    }

    public function removeAction(string $acid): bool {
        if (in_array($acid, array_keys($this->actions))) {
            unset($this->actions[$acid]);
            return true;
        }
        return false;
    }

}