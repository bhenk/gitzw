<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\site\Request;
use Throwable;
use function header;

class ErrorControl extends Page1cControl {

    private Throwable $error;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/base/500.css");
    }

    public function handleRequest(): void {
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
        $this->setPageTitle("404 at GITZW.ART");
    }

    public function renderContainer(): void {
        require_once Env::templatesDir() ."/base/500.php";
    }

    /**
     * @return Throwable
     */
    public function getError(): Throwable {
        return $this->error;
    }

    /**
     * @param Throwable $error
     */
    public function setError(Throwable $error): ErrorControl {
        $this->error = $error;
        return $this;
    }
}