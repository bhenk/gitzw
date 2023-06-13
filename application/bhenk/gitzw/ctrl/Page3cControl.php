<?php

namespace bhenk\gitzw\ctrl;

use bhenk\gitzw\base\Env;
use function date;

abstract class Page3cControl extends PageControl {

    private bool $includeHeader = true;
    private bool $includeContainer = true;
    private bool $includeColumn1 = true;
    private bool $includeColumn2 = true;
    private bool $includeColumn3 = true;
    private bool $includeFooter = true;
    private bool $includeCopyright = true;
    private string $copyrightText;
    private bool $stopRender = false;

    public function renderPage(): void {
        if ($this->stopRender) return;
        if ($this->includeCopyright) {
            $this->copyrightText = "&#169;1977" . "&nbsp;-&nbsp;" . date('Y')
                . " " . $this->getRequest()->getCreator()->getFullName()
                . "&nbsp;&bull;&nbsp;info at gitzw.art";
        }
        $this->addStylesheet("/css/base/3cp.css");
        require_once Env::templatesDir() . "/base/3cp.php";
    }

    /**
     * @param bool $stopRender
     */
    public function setStopRender(bool $stopRender): void {
        $this->stopRender = $stopRender;
    }

    /**
     * @return bool
     */
    public function includeHeader(): bool {
        return $this->includeHeader;
    }

    /**
     * @param bool $includeHeader
     */
    public function setIncludeHeader(bool $includeHeader): void {
        $this->includeHeader = $includeHeader;
    }

    public function renderHeader(): void {
        echo "header " . self::class;
    }

    public function renderBody(): void {
        echo "body " . self::class;
    }

    /**
     * @return bool
     */
    public function includeContainer(): bool {
        return $this->includeContainer;
    }

    /**
     * @param bool $includeContainer
     */
    public function setIncludeContainer(bool $includeContainer): void {
        $this->includeContainer = $includeContainer;
    }

    /**
     * @return bool
     */
    public function includeColumn1(): bool {
        return $this->includeColumn1;
    }

    /**
     * @param bool $includeColumn1
     */
    public function setIncludeColumn1(bool $includeColumn1): void {
        $this->includeColumn1 = $includeColumn1;
    }

    public function renderColumn1(): void {
        echo "column 1 " . self::class;
    }

    /**
     * @return bool
     */
    public function includeColumn2(): bool {
        return $this->includeColumn2;
    }

    /**
     * @param bool $includeColumn2
     */
    public function setIncludeColumn2(bool $includeColumn2): void {
        $this->includeColumn2 = $includeColumn2;
    }

    public function renderColumn2(): void {
        echo "column 2 " . self::class;
    }

    /**
     * @return bool
     */
    public function includeColumn3(): bool {
        return $this->includeColumn3;
    }

    /**
     * @param bool $includeColumn3
     */
    public function setIncludeColumn3(bool $includeColumn3): void {
        $this->includeColumn3 = $includeColumn3;
    }

    public function renderColumn3(): void {
        echo "column 3 <br/>" . "Page3cControl";
    }

    /**
     * @return bool
     */
    public function includeFooter(): bool {
        return $this->includeFooter;
    }

    /**
     * @param bool $includeFooter
     */
    public function setIncludeFooter(bool $includeFooter): void {
        $this->includeFooter = $includeFooter;
    }

    public function renderFooter(): void {
        echo "footer " . self::class;
    }

    public function includeCopyright(): bool {
        return $this->includeCopyright;
    }

    public function setIncludeCopyright(bool $includeCopyright): void {
        $this->includeCopyright = $includeCopyright;
    }

    public function getCopyrightText(): string {
        return $this->copyrightText;
    }
}