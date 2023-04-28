<?php

namespace bhenk\gitzw\base;

use bhenk\gitzw\dajson\User;
use bhenk\logger\log\Log;
use function date;
use function file_get_contents;
use function file_put_contents;
use function is_null;
use function json_decode;
use function json_encode;
use function session_destroy;

class Security {

    private static ?Security $instance = null;
    /** @var User[] */
    private array $users = array();
    private ?User $sessionUser = null;
    private bool $canLogin;

    function __construct() {
        $authData = $this->load();
        if (!empty($authData)) {
            foreach ($authData['users'] as $name => $data) {
                $user = new User($name, $data);
                $this->users[$name] = $user;
            }
        }
    }

    public static function get(): Security {
        if (is_null(self::$instance)) {
            Log::info("Instantiating Security");
            self::$instance = new Security();
        }
        return self::$instance;
    }

    public static function reset(): void {
        self::$instance = null;
    }

    private function getFilename(): string {
        return Env::dataDir() . DIRECTORY_SEPARATOR . "auth" . DIRECTORY_SEPARATOR . "users.json";
    }

    private function load(): array {
        return json_decode(file_get_contents($this->getFilename()), true);
    }

    public function serialize(): string {
        return json_encode(['users' => $this->users], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function persist(): void {
        file_put_contents($this->getFilename(), $this->serialize(), LOCK_EX);
    }

    public function getUserByName(string $name): bool|User {
        return $this->users[$name] ?? false;
    }

    public function getUsersByIp(string $ip = NULL) : array {
        if (empty($ip)) {
            $ip = Site::clientIp();
        }
        $maybeUsers = array();
        foreach ($this->users as $user) {
            if ($user->hasIp($ip)) {
                $maybeUsers[] = $user;
            }
        }
        return $maybeUsers;
    }

    public function canLogin(string $clientIp) : bool {
        if (!isset($this->canLogin)) {
            $this->canLogin = !empty($this->getUsersByIp($clientIp));
        }
        return $this->canLogin;
    }

    public function startSession(User $user, string $clientIp, string $date): void {
        $this->sessionUser = $user;
        $lastLogin = $user->getLastLogin();
        $user->setLastLogin($date);
        $this->persist();
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $user->getName();
        $_SESSION["full_name"] = $user->getFullName();
        $_SESSION["client_ip"] = $clientIp;
        $_SESSION["last_login"] = $lastLogin;
    }

    public function endSession(): bool {
        $this->sessionUser = NULL;
        $_SESSION = array();
        return session_destroy();
    }

    public function getSessionUser() : ?User {
        if (empty($this->sessionUser)) {
            if (!isset($_SESSION["logged_in"]) or !$_SESSION["logged_in"]) {
                return NULL;
            }
            if (Site::clientIp() != $_SESSION["client_ip"]) {
                Log::critical("Session hijacked",
                    ['username'=>$_SESSION["username"],
                        'session_client_ip'=>$_SESSION["client_ip"],
                        'current_client_ip'=>Site::clientIp()
                    ]);
                $this->endSession();
                return NULL;
            }
            $this->sessionUser = $this->getUserbyName($_SESSION["username"]);
        }
        return $this->sessionUser;
    }

}