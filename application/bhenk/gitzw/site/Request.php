<?php

namespace bhenk\gitzw\site;

use bhenk\gitzw\base\Site;
use bhenk\gitzw\dajson\User;
use bhenk\gitzw\dat\Creator;
use bhenk\logger\log\Log;
use bhenk\logger\log\Req;
use function date;
use function explode;
use function is_null;
use function parse_url;
use function preg_replace;
use function str_starts_with;
use function strtolower;
use function substr;

class Request {

    private string $request;
    private string $cleanUrl;
    private array $url_array;
    private string $clientIP;
    private string $requestDate;
    private ?User $sessionUser = null;
    private ?Creator $creator = null;

    /**
     * Constructs a new Request
     */
    function __construct() {
        $this->requestDate = date("Y-m-d H:i:s", $_SERVER["REQUEST_TIME"]);
        Req::info("");
        $this->request = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        Log::info("------------------- request: " . $this->request);
        $this->cleanUrl = strtolower(preg_replace("/[^0-9a-zA-Z\/._ +]/", "-", $this->request));
        $offset = str_starts_with($this->cleanUrl, "/") ? 1 : 0;
        $this->url_array = explode('/', substr($this->cleanUrl, $offset));
        $this->clientIP = Site::clientIp();
    }

    /**
     * Gets the raw *REQUEST_URI* from the server
     * @return string
     */
    public function getRawUrl(): string {
        return $this->request;
    }

    /**
     * Get the sanitized *REQUEST_URI*
     *
     * All non ``0-9a-zA-Z/._+`` are replaced with ``-`` and all chars are made lower case.
     * @return string
     */
    public function getCleanUrl(): string {
        return $this->cleanUrl;
    }

    /**
     * Get the *REQUEST_URI* as an array, split on forward slash
     *
     * The first "/", if any, is omitted.
     * @return string[]
     */
    public function getUrlArray(): array {
        return $this->url_array;
    }

    /**
     * Get the part of the *REQUEST_URI* indicated by *$index* or empty string if it does not exist
     *
     * @param int $index
     * @return string
     */
    public function getUrlPart(int $index): string {
        return $this->url_array[$index] ?? "";
    }

    /**
     * Get the IP address of the client
     *
     * @return string
     */
    public function getClientIP(): string {
        return $this->clientIP;
    }

    /**
     * Get the date and time of the request
     *
     * @return string date time in format "Y-m-d H:i:s"
     */
    public function getRequestDate(): string {
        return $this->requestDate;
    }


    public function getSessionUser(): ?User {
        return $this->sessionUser;
    }

    public function setSessionUser(?User $sessionUser): void {
        $this->sessionUser = $sessionUser;
    }

    public function hasSessionUser(): bool {
        return !is_null($this->sessionUser);
    }

    public function getCreator(): ?Creator {
        return $this->creator;
    }

    public function setCreator(?Creator $creator): void {
        $this->creator = $creator;
    }

    public function hasCreator(): bool {
        return !is_null($this->creator);
    }

}