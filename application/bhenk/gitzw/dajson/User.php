<?php

namespace bhenk\gitzw\dajson;

use JsonSerializable;
use function in_array;
use function password_verify;

class User implements JsonSerializable {

    const FULL_NAME = 'full_name';
    const EMAIL = 'email';
    const HASHED = 'hashed';
    const ROLES = 'roles';
    const IPS = 'ips';
    const LAST_LOGIN = "last_login";

    private string $name;
    private string $fullName;
    private string $email;
    private string $hashed;
    private array $roles = array();
    private array $ips = array();
    private string $lastLogin;

    /**
     * @param string $name
     * @param array $data
     */
    function __construct(string $name, array $data = []) {
        $this->name = $name;
        $this->fullName = $data[self::FULL_NAME] ?? "";
        $this->email = $data[self::EMAIL] ?? "";
        $this->hashed = $data[self::HASHED] ?? "";
        $this->roles = $data[self::ROLES] ?? [];
        $this->ips = $data[self::IPS] ?? [];
        $this->lastLogin = $data[self::LAST_LOGIN] ?? "";
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName(): string {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getHashed(): string {
        return $this->hashed;
    }

    /**
     * @return array
     */
    public function getRoles(): array {
        return $this->roles;
    }

    /**
     * @return array
     */
    public function getIps(): array {
        return $this->ips;
    }

    public function hasIp(string $ip) : bool {
        return in_array($ip, $this->ips);
    }

    /**
     * @return string
     */
    public function getLastLogin(): string {
        return $this->lastLogin;
    }

    /**
     * @param string $lastLogin
     * @return void
     */
    public function setLastLogin(string $lastLogin): void {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPass(string $password) : bool {
        return password_verify($password, $this->hashed);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array {
        return [
            self::FULL_NAME=>$this->fullName,
            self::EMAIL=>$this->email,
            self::HASHED=>$this->hashed,
            self::ROLES=>$this->roles,
            self::IPS=>$this->ips,
            self::LAST_LOGIN=>$this->lastLogin
        ];
    }

}