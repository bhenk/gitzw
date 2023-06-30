<?php

namespace bhenk\gitzw\dajson;

use bhenk\gitzw\base\Env;
use function file_get_contents;
use function file_put_contents;
use function json_decode;
use function json_encode;

class UserRegistry {

    /** @var User[]  */
    private array $users = array();

    function __construct() {
        $authData = $this->load();
        if (!empty($authData)) {
            foreach ($authData["users"] as $name => $data) {
                $user = new User($name, $data);
                $this->users[$name] = $user;
            }
        }
    }

    private function getFilename(): string {
        return Env::dataDir() . DIRECTORY_SEPARATOR . "auth" . DIRECTORY_SEPARATOR . "users.json";
    }

    private function load(): array {
        return json_decode(file_get_contents($this->getFilename()), true);
    }

    public function serialize(): string {
        return json_encode(["users" => $this->users], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function getUserByName(string $name): bool|User {
        return $this->users[$name] ?? false;
    }

    public function getUsersByIp(string $ip): array {
        $maybeUsers = [];
        foreach ($this->users as $user) {
            if ($user->hasIp($ip)) {
                $maybeUsers[] = $user;
            }
        }
        return $maybeUsers;
    }

}