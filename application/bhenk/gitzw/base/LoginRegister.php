<?php

namespace bhenk\gitzw\base;

use bhenk\gitzw\dajson\Login;
use bhenk\logger\log\Log;
use Exception;
use function array_keys;
use function file_exists;
use function file_get_contents;
use function file_put_contents;
use function in_array;
use function json_decode;
use function json_encode;

/**
 * Keeps track of login success and failure and from which client IP the attempt was launched
 *
 * See Json file at location given by {@link LoginRegister::getFilename()}.
 */
class LoginRegister {

    private static ?LoginRegister $instance = null;

    /** @var Login[] */
    private array $logins = [];

    private function __construct() {
        $loginData = $this->load();
        if (!empty($loginData)) {
            foreach ($loginData['logins'] as $ip => $data) {
                $login = new Login($ip, $data);
                $this->logins[$ip] = $login;
            }
        }
    }

    /**
     * Get singleton instance of this class
     *
     * Loads {@link Login}s from file at {@link LoginRegister::getFilename()}.
     * @return LoginRegister
     */
    public static function get(): LoginRegister {
        if (is_null(self::$instance)) {
            Log::info("Instantiating LoginRegister");
            self::$instance = new LoginRegister();
        }
        return self::$instance;
    }

    /**
     * Reset the LoginRegister
     *
     * Next time around will read data from file.
     * @return void
     */
    public static function reset(): void {
        self::$instance = null;
    }

    /**
     * @param string $clientIp
     * @param string $date
     * @return bool
     * @throws Exception
     */
    public function canLogin(string $clientIp, string $date): bool {
        if (!in_array($clientIp, array_keys($this->logins))) return true;
        $login = $this->logins[$clientIp];
        return $login->canLogin($date);
    }

    public function addLoginAttempt(string $clientIp, string $date, bool $success): void {
        if (!in_array($clientIp, array_keys($this->logins))) {
            $login = new Login($clientIp, []);
            $this->logins[$clientIp] = $login;
        }
        $login = $this->logins[$clientIp];
        $login->addLoginAttempt($date, $success);
        $this->persist();
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

}