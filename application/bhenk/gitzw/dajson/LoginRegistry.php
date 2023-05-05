<?php

namespace bhenk\gitzw\dajson;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use function array_keys;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function in_array;
use function json_decode;
use function json_encode;

class LoginRegistry {

    /** @var Login[] */
    private array $logins = [];

    function __construct() {
        $loginData = $this->load();
        if (!empty($loginData)) {
            foreach ($loginData['logins'] as $ip => $data) {
                $login = new Login($ip, $data);
                $this->logins[$ip] = $login;
            }
        }
    }

    public function getFilename(): string {
        return Env::dataDir() . DIRECTORY_SEPARATOR . "auth" . DIRECTORY_SEPARATOR . "logins.json";
    }

    private function load(): array {
        if (!file_exists($this->getFilename())) return [];
        return json_decode(file_get_contents($this->getFilename()), true);
    }

    public function serialize(): string {
        return json_encode(['logins' => $this->logins], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function addLoginAttempt(Request $request, bool $success): void {
        if (!in_array($request->getClientIP(), array_keys($this->logins))) {
            $login = new Login($request->getClientIP(), []);
            $this->logins[$request->getClientIP()] = $login;
        }
        $login = $this->logins[$request->getClientIP()];
        $login->addLoginAttempt($request->getRequestDate(), $success);
        $this->persist();
    }

    public function isNotBruteForce(Request $request): bool {
        if (!in_array($request->getClientIP(), array_keys($this->logins))) return true;
        $login = $this->logins[$request->getClientIP()];
        return $login->canLogin($request->getRequestDate());
    }

}