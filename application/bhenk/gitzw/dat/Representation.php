<?php

namespace bhenk\gitzw\dat;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\base\Images;
use bhenk\gitzw\dao\RepresentationDo;
use bhenk\gitzw\model\DateTrait;
use bhenk\gitzw\model\StoredObjectInterface;
use Exception;
use ReflectionException;
use function exif_read_data;
use function json_decode;
use function json_encode;
use function restore_error_handler;
use function set_error_handler;
use function str_replace;

/**
 * A Representation represents a manifestation of a Work
 */
class Representation implements StoredObjectInterface {
    use DateTrait;

    const IMG_DIR = "images";

    private RepresentationRelations $relations;
    private array $errors = [];

    function __construct(private readonly RepresentationDo $repDo = new RepresentationDo()) {
        $this->initDateTrait($this->repDo);
        $this->relations = new RepresentationRelations($this->getID());
    }

    public function getID(): ?int {
        return $this->repDo->getID();
    }

    public function serialize(): string {
        return json_encode(["representationDo" => $this->repDo->toArray()],
            JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    }

    /**
     * @throws ReflectionException
     */
    public static function deserialize(string $serialized): Representation {
        $array = json_decode($serialized, true);
        return new Representation(RepresentationDo::fromArray($array["representationDo"]));
    }

    /**
     * @return string|null
     */
    public function getREPID(): ?string {
        return $this->repDo->getREPID();
    }

    /**
     * @param string $REPID
     */
    public function setREPID(string $REPID): void {
        $this->repDo->setREPID($REPID);
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string {
        return $this->repDo->getSource();
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void {
        $this->repDo->setSource($source);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->repDo->getDescription();
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void {
        $this->repDo->setDescription($description);
    }

    /**
     * @return RepresentationDo
     */
    public function getRepresentationDo(): RepresentationDo {
        return $this->repDo;
    }

    /**
     * @return RepresentationRelations
     */
    public function getRelations(): RepresentationRelations {
        return $this->relations;
    }

    /**
     * Get the filename of this Representation or *null* if not yet set
     * @return bool|string
     * @throws Exception
     */
    public function getFilename(): bool|string {
        $REPID = $this->repDo->getREPID();
        if (is_null($REPID)) return false;
        return Env::dataDir() . DIRECTORY_SEPARATOR
            . self::IMG_DIR . DIRECTORY_SEPARATOR . $this->repDo->getREPID();
    }

    public function getFileLocation(array $dimensions = Images::IMG_30): string {
        return Images::locationForREPID($this->getREPID(), $dimensions);
    }

    /**
     * Get Exif Data of this Representation or *false* if no file
     * @return bool|array
     * @throws Exception
     */
    public function getExifData(): bool|array {
        return exif_read_data($this->getFilename(), 0, true);
    }

    /**
     * Get exif data and handle warnings
     *
     * In case of error, first key in returned array reads 'error'.
     *
     * @return array Exif data or caught warning messages if no data available
     * @throws Exception
     */
    public function getSecureExifData(): array {
        $this->errors = [];
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $this->errors["error"] = "While reading '" . $this->getREPID() . "'";
            $this->errors["errno"] = $errno;
            $this->errors["errstr"] = $errstr;
//            $this->errors["errfile"] = $errfile;
//            $this->errors["errline"] = $errline;
        });
        $exif = exif_read_data($this->getFilename(), 0, true);
        restore_error_handler();
        if (!$exif) return $this->errors;
        return $exif;
    }

    /**
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * Returns the Structured Data ID
     *
     * example: "http://gitzw.art/#hnq.2020._DSC0533_00022.jpg"
     * @return string
     */
    public function getSDId(): string {
        return Env::HTTP_URL . "/#" . str_replace("/", ".", $this->getREPID());
    }

    public function getStructuredData(): array {
        return [
            "@type" => "ImageObject",
            "@id" => $this->getSDId(),
            "url" => Env::HTTPS_URL . $this->getFileLocation(),
        ];
    }

}