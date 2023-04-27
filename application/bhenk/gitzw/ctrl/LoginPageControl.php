<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\dajson\Security;
use function session_start;

class LoginPageControl extends Page1cControl {

    private string $message = "";
    private string $username = "";
    private bool $name_error = false;
    private bool $pass_error = false;
    private string $hash = "";

    public function canHandle(array|string $path): bool {
        if (!Security::get()->canLogin()) return false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePost();
        } else {
            $this->renderPage();
        }
        return true;
    }

    private function handlePost(): void {
        if ($_POST["action"] == "login") $this->handleLogin();
        if ($_POST["action"] == "hash") {
            $this->hash = password_hash($_POST["word"], PASSWORD_DEFAULT );
            $this->renderPage();
        }
    }

    private function handleLogin(): void {
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
            $this->message = "Unknown username or password";
            $this->renderPage();
            return;
        }
        $clientIp = Site::clientIp();
        if (!$user->hasIp($clientIp)) {
            $this->message = "Ip $clientIp not associated with $this->username";
            $this->renderPage();
            return;
        }
        // send session cookie
        session_start();
        Security::get()->startSession($user);
        Site::redirect("/admin");
    }

    public function renderPage(): void {
        $this->setPageTitle("Login");
        $this->addStylesheet("/css/auth/auth.css");
        parent::renderPage();
    }

    public function renderBody(): void {
        require_once Env::templatesDir() . "/auth/login.php";
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