<?php

namespace bhenk\gitzw\ctrl;

use bhenk\logger\log\Log;
use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\LoginRegister;
use bhenk\gitzw\base\Security;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\dajson\User;
use function date;
use function implode;
use function is_array;
use function is_null;

class LoginPageControl extends Page3cControl {

    private string $message = "";
    private string $username = "";
    private bool $name_error = false;
    private bool $pass_error = false;
    private string $hash = "";
    private User|bool|null $sessionUser = null;

    public function canHandle(array|string $path): bool {
        $clientIp = Site::clientIp();
        $date = date("Y-m-d H:i:s");
        if (!Security::get()->canLogin($clientIp)) return false;
        if (!LoginRegister::get()->canLogin($clientIp, $date)) return false;
        if (is_array($path)) {
            $path = $path[0] ?? "";
        }
        if (!($path == "login" or $path == "logout")) return false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePost($clientIp, $date);
        } elseif($path == "login") {
            $this->renderPage();
        } else {
            $this->handleLogout();
        }
        return true;
    }

    private function handlePost(string $clientIp, string $date): void {
        if ($_POST["action"] == "login") $this->handleLogin($clientIp, $date);
        if ($_POST["action"] == "hash") {
            $this->hash = password_hash($_POST["word"], PASSWORD_DEFAULT );
            $this->renderPage();
        }
    }

    private function handleLogin(string $clientIp, string $date): void {
        Log::info("handle login from IP $clientIp");
        $this->username = $_POST["username"];
        $this->name_error = empty($this->username);
        $pass = $_POST["password"];
        $this->pass_error = empty($pass);
        if ($this->name_error or $this->pass_error) {
            $this->message = "Please complete missing fields";
            $this->renderPage();
            return;
        }
        $user = Security::get()->getUserByName($this->username);
        if (!$user or !$user->verifyPass($pass)) {
            LoginRegister::get()->addLoginAttempt($clientIp, $date, false);
            $this->message = "Unknown username or password";
            $this->renderPage();
            return;
        }
        if (!$user->hasIp($clientIp)) {
            LoginRegister::get()->addLoginAttempt($clientIp, $date, false);
            $this->message = "Ip $clientIp not associated with $this->username";
            $this->renderPage();
            return;
        }
        // redirect??
        $next_path = $_SESSION["next_path"] ?? false;

        LoginRegister::get()->addLoginAttempt($clientIp, $date, true);
        Security::get()->startSession($user, $clientIp, $date);
        if (!$next_path) {
            Site::redirect("/admin");
        } else {
            Site::redirect($next_path);
        }
    }

    private  function handleLogout(): void {
        Security::get()->endSession();
        Site::redirect("");
    }

    public function renderPage(): void {
        $this->setPageTitle("Login " . Site::hostName());
        $this->addStylesheet("/css/auth/login.css");
        $this->setIncludeHeader(false);
        $this->setIncludeContainer(false);
        $this->setIncludeFooter(false);
        parent::renderPage();
    }

    public function renderBody(): void {
        require_once Env::templatesDir() . "/auth/login.php";
    }

    public function getSessionUser(): User|bool {
        if (is_null($this->sessionUser)) {
            $user = Security::get()->getSessionUser();
            if (is_null($user)) {
                $this->sessionUser = false;
            } else {
                $this->sessionUser = $user;
            }
        }
        return $this->sessionUser;
    }

    public function getSessionUserFullName(): string {
        return $this->sessionUser ? $this->sessionUser->getFullName() : "";
    }

    public function getSessionUserName(): string {
        return $this->sessionUser ? $this->sessionUser->getName() : "";
    }

    public function getSessionUserLastLogin(): string {
        return $this->sessionUser ? $this->sessionUser->getLastLogin() : "";
    }

    public function getClientIp(): string {
        return Site::clientIp();
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @return bool
     */
    public function hasNameError(): bool {
        return $this->name_error;
    }

    /**
     * @return bool
     */
    public function hasPassError(): bool {
        return $this->pass_error;
    }

    /**
     * @return string
     */
    public function getHash(): string {
        return $this->hash;
    }

}