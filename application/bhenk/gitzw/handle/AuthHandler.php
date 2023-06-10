<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\HomePageControl;
use bhenk\gitzw\ctrl\LoginPageControl;
use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use DateTime;
use Exception;
use function in_array;
use function intval;
use function print_r;
use function session_destroy;
use function session_start;
use function str_contains;
use function str_starts_with;

class AuthHandler extends AbstractHandler {

    private static array $restricted = [
        "admin",
    ];

    /**
     * Handles authentication
     *
     * * starts a session
     * * checks on *logged_in* status of session, if so
     *      - sets sessionUser on request or -> NotFoundHandler
     *      - checks if restricted and session is expired -> redirect /login or -> NotFoundHandler
     *
     * Handles: /login, /logout, /admin.
     *
     * A request that is passed on from this to the next handler is guaranteed to assail unrestricted territory.
     *
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function handleRequest(Request $request): void {
        $first = $request->getUrlPart(0);
        if (isset($_SESSION["logged_in"]) and $_SESSION["logged_in"]) {
            if (!$this->setSessionUser($request)) return;
            if ($first == "logout") {
                $this->endSession($request);
                $path = $_SERVER["HTTP_REFERER"] ?? "";
                if (str_contains($path, "admin")) $path = "";
                Site::redirect($path);
                return;
            }
            if ($this->isRestricted($request) && $this->sessionExpired($request)) return;
        }

        if ($first == "") {
            $ctrl = new HomePageControl($request);
            $ctrl->handleRequest();
            return;
        }

        if ($first == "login") {
            if ($this->canLogin($request)) {
                $ctrl = new LoginPageControl($request);
                $ctrl->handleRequest();
            } else {
                (new NotFoundHandler())->handleRequest($request);
            }
            return;
        }

        if ($first == "admin") {
            if ($request->hasSessionUser()) {
                (new AdminHandler())->handleRequest($request);
            } else {
                (new NotFoundHandler())->handleRequest($request);
            }
            return;
        }

        $this->getNextHandler()?->handleRequest($request);
    }

    private function setSessionUser(Request $request): bool {
        if (Site::clientIp() != $_SESSION["client_ip"]) {
            Log::critical("Session hijacked",
                ['username'=>$_SESSION["username"],
                    'session_client_ip'=>$_SESSION["client_ip"],
                    'current_client_ip'=>Site::clientIp()
                ]);
            $this->endSession($request);
            (new NotFoundHandler())->handleRequest($request);
            return false;
        }
        $sessionUser = Registry::userRegistry()->getUserbyName($_SESSION["username"]);
        if (!$sessionUser) {
            $this->endSession($request);
            (new NotFoundHandler())->handleRequest($request);
            return false;
        }
        Log::info("Found sessionUser: " . $sessionUser->getName() . " " . $sessionUser->getLastLogin());
        $request->setSessionUser($sessionUser);
        return true;
    }

    private function endSession(Request $request): void {
        Log::info("End session: " . print_r($_SESSION, TRUE));
        $request->setSessionUser(null);
        $_SESSION = array();
        session_destroy();
    }

    private function isRestricted(Request $request): bool {
        return in_array($request->getUrlPart(0), self::$restricted);
    }

    private function sessionExpired(Request $request): bool {
        $last_access = $_SESSION["last_access"] ?? false;
        if (!$last_access) {
            $msg = "This can never happen: SESSION['logged_in'] and no last_access";
            Log::critical($msg);
            $this->endSession($request);
            (new NotFoundHandler())->handleRequest($request);
            return true;
        }
        $_SESSION["last_access"] = $request->getRequestDate();
        // session expired?
        $last = new DateTime($last_access);
        $now = new DateTime($request->getRequestDate());
        $diff = $last->diff($now);
        $days = intval($diff->format("%R%a"));
        $hours = intval($diff->format("%R%h"));
        $minutes = intval($diff->format("%R%i")) + $hours * 60 + $days * 24 * 60;
        if ($minutes >= Env::sessionExpirationMinutes()) {
            $user = $_SESSION["username"];
            $path = $request->getRawUrl();
            Log::info("Session expired: sessionUser='$user', minutes=$minutes, path=$path" );
            $this->endSession($request);
            session_start();
            $_SESSION["next_path"] = $path;
            Site::redirect("/login");
            return true;
        }
        return false;
    }

    private function canLogin(Request $request): bool {
        $hasKnownIP = !empty(Registry::userRegistry()->getUsersByIp($request->getClientIP()));
        return $hasKnownIP && Registry::loginRegistry()->isNotBruteForce($request);
    }
}