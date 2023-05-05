<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\dajson\User;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function print_r;

class LoginPageControl extends Page3cControl {

    private string $message = "";
    private string $username = "";
    private bool $name_error = false;
    private bool $pass_error = false;
    private string $hash = "";
    private User|bool $sessionUser = false;

    function __construct(Request $request) {
        parent::__construct($request);
    }

    public function handleRequest(): void {
        $this->sessionUser = $this->getRequest()->getSessionUser() ?? false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handlePost();
        } else {
            $this->renderPage();
        }
    }

    private function handlePost(): void {
        if ($_POST["action"] == "login") $this->handleLogin();
        if ($_POST["action"] == "hash") {
            $this->hash = password_hash($_POST["word"], PASSWORD_DEFAULT );
            $this->renderPage();
        }
    }

    private function handleLogin(): void {
        $clientIp = $this->getRequest()->getClientIP();
        Log::info("handle login from IP " . $clientIp);
        $this->username = $_POST["username"];
        $this->name_error = empty($this->username);
        $pass = $_POST["password"];
        $this->pass_error = empty($pass);
        if ($this->name_error or $this->pass_error) {
            $this->message = "Please complete missing fields";
            $this->renderPage();
            return;
        }
        $user = Registry::userRegistry()->getUserByName($this->username);
        if (!$user or !$user->verifyPass($pass)) {
            Registry::loginRegistry()->addLoginAttempt($this->getRequest(), false);
            $this->message = "Unknown username or password";
            $this->renderPage();
            return;
        }
        if (!$user->hasIp($clientIp)) {
            Registry::loginRegistry()->addLoginAttempt($this->getRequest(), false);
            $this->message = "Ip $clientIp not associated with $this->username";
            $this->renderPage();
            return;
        }
        $this->sessionUser = $user;
        $this->getRequest()->setSessionUser($user);
        // redirect??
        $next_path = $_SESSION["next_path"] ?? false;
        Registry::loginRegistry()->addLoginAttempt($this->getRequest(), true);
        $this->startSession();
        if ($next_path) {
            unset($_SESSION["next_path"]);
            Site::redirect($next_path);
        } else {
            Site::redirect("/admin");
        }
    }

    private function startSession(): void {
        $lastLogin = $this->sessionUser->getLastLogin();
        $this->sessionUser->setLastLogin($this->getRequest()->getRequestDate());
        Registry::userRegistry()->persist();
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $this->sessionUser->getName();
        $_SESSION["full_name"] = $this->sessionUser->getFullName();
        $_SESSION["client_ip"] = $this->getRequest()->getClientIP();
        $_SESSION["last_login"] = $lastLogin;
        $_SESSION["last_access"] = $this->getRequest()->getRequestDate();
        Log::info("Start session: " . print_r($_SESSION, TRUE));
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

    public function getSessionUser(): bool|User {
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