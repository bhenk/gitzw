<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function header;

class NotFoundControl extends Page1cControl {

    private int $error_code = 404;
    private bool $displayIP = false;

    private array $error_strings = [
        400 => "Bad Request",
        401 => "Unauthorized",
        403 => "Forbidden",
        404 => "Not Found",
        418 => "I'm a teapot",
    ];

    function __construct(Request $request) {
        Log::info("Handling 40x for " . $request->getRawUrl());
        parent::__construct($request);
        $this->addStylesheet("/css/base/404.css");
    }

    public function handleRequest(): void {
        $str = " $this->error_code " . $this->getErrorString();
        header($_SERVER["SERVER_PROTOCOL"] . $str, true, $this->error_code);
        $this->setPageTitle("$this->error_code at GITZW.ART");
    }

    public function renderContainer(): void {
        require_once Env::templatesDir() ."/base/40x.php";
    }

    /**
     * @return int
     */
    public function getErrorCode(): int {
        return $this->error_code;
    }

    /**
     * @param int $error_code
     */
    public function setErrorCode(int $error_code): void {
        $this->error_code = $error_code;
    }

    public function getErrorString() {
        return $this->error_strings[$this->error_code] ?? "Not Found";
    }

    /**
     * @return bool
     */
    public function showIP(): bool {
        return $this->displayIP;
    }

    /**
     * @param bool $displayIP
     */
    public function setShowIP(bool $displayIP): void {
        $this->displayIP = $displayIP;
    }
}