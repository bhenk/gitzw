<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\dajson\User;
use bhenk\gitzw\dat\Representation;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\site\Menu;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use function is_null;

class RepresentationsPageControl extends AdminPageControl {

    const LIMIT = 10;

    /** @var Representation[] */
    private array $representations;
    private int $offset = 0;
    private string $sourceCount;
    private int $total_reps;

    function __construct(Request $request) {
        parent::__construct($request);
        $this->setPageTitle("Representations");
        //$this->addStylesheet();
    }

    public function handleRequest(): void {
        $sources = Store::representationStore()->countBySource();
        $this->sourceCount = "";
        $this->total_reps = 0;
        foreach ($sources as $source => $count) {
            if ($source == "") $source = "unknown";
            $this->sourceCount .= "$source: $count &nbsp;";
            $this->total_reps += $count;
        }
        $this->sourceCount .= "total: $this->total_reps &nbsp;";

        $np = $this->getRequest()->getUrlPart(2);
        $this->offset = intval($this->getRequest()->getUrlPart(3));
        if ($np == "previous") {
            $this->offset = $this->offset - self::LIMIT;
            if ($this->offset < 0) $this->offset = 0;
        } elseif ($np == "next") {
            $this->offset = $this->offset + self::LIMIT;
            if ($this->offset > $this->total_reps) $this->offset = $this->offset - self::LIMIT;
        }
        $this->representations = Store::representationStore()
            ->orderByYear("1=1", $this->offset, self::LIMIT, true );
    }


    /**
     * @return Representation[]
     */
    public function getRepresentations(): array {
        return $this->representations;
    }

    /**
     * @return string
     */
    public function getSourceCount(): string {
        return $this->sourceCount;
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/admin/rep_list_2.php";
    }

    /**
     * @return int
     */
    public function getOffset(): int {
        return $this->offset;
    }

    public function previousDisabled(): string {
        return ($this->offset <= 0) ? " disabled" : "";
    }

    public function nextDisabled(): string {
        return ($this->offset + self::LIMIT >= $this->total_reps) ? " disabled" : "";
    }

    public function renderColumn3(): void {
        require_once Env::templatesDir() . "/admin/rep_list_3.php";
    }

}