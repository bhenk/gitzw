<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Images;
use bhenk\gitzw\dao\CreatorDo;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\model\PersonTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use bhenk\gitzw\model\WorkCategories;
use Exception;
use ReflectionException;
use function addslashes;
use function array_reverse;
use function array_shift;
use function is_null;
use function json_decode;
use function json_encode;
use function str_replace;
use function substr;
use function urldecode;

class Creator implements StoredObjectInterface {
    use PersonTrait;

    function __construct(private readonly CreatorDo $creatorDo = new CreatorDo()) {
        $this->initPersonTrait($this->creatorDo);
    }

    /**
     * @param string $serialized
     * @return Creator
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Creator {
        $array = json_decode($serialized, true);
        return new Creator(CreatorDo::fromArray($array["creatorDo"]));
    }

    public function serialize(): string {
        return json_encode(["creatorDo" => $this->creatorDo->toArray()], JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    public function getID(): ?int {
        return $this->creatorDo->getID();
    }

    /**
     * Returns the short 3-letter sequence after url in CRID
     * @return string|null
     */
    public function getShortCRID(): ?string {
        $crid = $this->creatorDo->getCRID();
        if (is_null($crid)) return null;
        return substr($crid, strrpos($crid, "/") + 1);
    }

    /**
     * @return CreatorDo
     */
    public function getCreatorDo(): CreatorDo {
        return $this->creatorDo;
    }

    /**
     * Get Works by this Creator
     * @param int $offset start index
     * @param int $limit max number of Works to return
     * @return array<int, Work> array of Works or empty array if end of storage reached
     * @throws Exception
     */
    public function getWorks(int $offset = 0, int $limit = PHP_INT_MAX): array {
        return Store::workStore()->selectByCreator($this, $offset, $limit);
    }

    /**
     * Get all categories of this creator
     * @param bool $showHidden
     * @return WorkCategories[]
     */
    public function getCategories(bool $showHidden = false): array {
        return Store::workStore()->getCategories("creatorId=" . $this->getID(), $showHidden);
    }

    /**
     * Get image data for carousel
     * @return array rows
     * @throws Exception
     */
    public function getImageData(WorkCategories $cat, array $size = Images::IMG_04, int $offset = 0, int $limit = 100): array {
        $sql = "SELECT w.RESID, w.title_nl, w.title_en, w.preferred, YEAR(w.date) as `year`, r.REPID, wr.ordinal FROM tbl_works w "
            . "INNER JOIN tbl_work_rep wr ON w.ID = wr.FK_LEFT "
            . "INNER JOIN tbl_representations r ON wr.FK_RIGHT = r.ID "
            . "WHERE w.creatorId = " . $this->getID()
            . " AND w.category = '" . $cat->name . "' AND w.hidden = 0 AND wr.carousel = 1 "
            . "ORDER BY w.ordering DESC, wr.ordinal LIMIT $offset,$limit;";
        $rows = Dao::workDao()->execute($sql);
        $images = [];
        $titles = [];
        $years = [];
        $resids = [];
        $urls = [];
        foreach ($rows as $row) {
            $images[] = "/img/resized/" . $size[0] . "x" . $size[1] . "/" . $row["REPID"];
            $title = "-no title-";
            if ($row["preferred"] == "nl") {
                $first = $row["title_nl"];
                $second = $row["title_en"];
            } else {
                $first = $row["title_en"];
                $second = $row["title_nl"];
            }
            if ($first and $second) {
                $title = $first . " (" . $second . ")";
            } elseif ($first) {
                $title = $first;
            } elseif ($second) {
                $title = $second;
            }
            $title .= " (" . $row["year"] . ")";
            $titles[] = addslashes($title);
            $years[] = $row["year"];
            $resids[] = $row["RESID"];
            // hnq.work.paint.1993.0009
            $urls[] = "/" . $this->getUriName() . "/work/" . $cat->value
                . "/" . str_replace(".", "/", substr($row["RESID"], -9));
        }
        $b = array_reverse($titles);
        $b[] = array_shift($b);
        $b[] = array_shift($b);
        $b[] = array_shift($b);
        $titles = array_reverse($b);

        $b = array_reverse($years);
        $b[] = array_shift($b);
        $b[] = array_shift($b);
        $b[] = array_shift($b);
        $years = array_reverse($b);
        return ["images" => $images, "titles" => $titles, "years" => $years, "resids" => $resids, "urls" => $urls];
    }

}