<?php

namespace bhenk\gitzw\base;

use bhenk\gitzw\dajson\User;
use bhenk\logger\log\Log;
use DateTime;
use Exception;
use function date;
use function file_get_contents;
use function file_put_contents;
use function is_null;
use function json_decode;
use function json_encode;
use function print_r;
use function session_destroy;
use function session_start;

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
        $_SESSION["last_access"] = $date;
        Log::info("Start session: " . print_r($_SESSION, TRUE));
    }

    public function endSession(): bool {
        Log::info("End session: " . print_r($_SESSION, TRUE));
        $this->sessionUser = NULL;
        $_SESSION = array();
        return session_destroy();
    }

    public function getSessionUser() : ?User {
        if (empty($this->sessionUser)) {
            if (!isset($_SESSION["logged_in"]) or !$_SESSION["logged_in"]) {
                Log::info("No sessionUser: returning null");
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
            Log::info("Found sessionUser: " . $this->sessionUser->getName()
                . " " . $this->sessionUser->getLastLogin());
        }
        return $this->sessionUser;
    }

    /**
     * Checks if session expired, if so, redirects to login page
     *
     * If redirected to login page, original requested path will be on *$_SESSION["next_path"]*
     *
     * @param string $path requested path
     * @return bool *true* if session expired, *false* otherwise, indicating request must be handled
     *    further down the stack
     * @throws Exception
     */
    public function sessionExpired(string $path): bool {
        if (!isset($_SESSION["logged_in"]) or !$_SESSION["logged_in"]) {
            $msg = "This can never happen: SESSION['logged_in'] and !SESSION['logged_in']";
            Log::critical($msg);
            throw new Exception($msg);
        }
        if (!$this->getSessionUser()) {
            $msg = "This can never happen: SESSION['logged_in'] and no sessionUser";
            Log::critical($msg);
            throw new Exception($msg);
        }
        $last_access = $_SESSION["last_access"] ?? false;
        if (!$last_access) {
            $msg = "This can never happen: SESSION['logged_in'] and no last_access";
            Log::critical($msg);
            throw new Exception($msg);
        }

        $date = date("Y-m-d H:i:s");
        $_SESSION["last_access"] = $date;

        // session expired?
        $last = new DateTime($last_access);
        $now = new DateTime($date);
        $diff = $last->diff($now);
        $days = intval($diff->format("%R%a"));
        $hours = intval($diff->format("%R%h"));
        $minutes = intval($diff->format("%R%i")) + $hours * 60 + $days * 24 * 60;
        if ($minutes >= Env::sessionExpirationMinutes()) {
            $user = $_SESSION["username"];
            Log::info("Session expired: sessionUser='$user', minutes=$minutes, path=$path" );
            $this->endSession();
            session_start();
            $_SESSION["next_path"] = $path;
            Site::redirect("/login");
            return true;
        }
        return false;
    }

}