<?php

namespace bhenk\gitzw\ctrla;

use bhenk\gitzw\base\Env;
use bhenk\gitzw\ctrl\Page3cControl;
use bhenk\gitzw\dajson\Registry;
use bhenk\gitzw\dao\Dao;
use bhenk\gitzw\dat\Store;
use bhenk\gitzw\model\ProgressListener;
use bhenk\gitzw\site\Request;
use bhenk\logger\log\Log;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Phar;
use PharData;
use function array_sum;
use function date;
use function is_null;
use function readfile;
use function time;
use function unlink;

class StoreControl extends Page3cControl {

    const ID_SERIALIZE = "progress_store_s";
    const ID_DESERIALIZE = "progress_store_d";

    private ?array $serializationStats = null;
    private array $serializationResult = [];
    private int $serializedRecordCount = -1;
    private ?array $storeStats = null;
    private bool $showDeserialize = false;
    private array $storeResult = [];
    private int $storedObjectCount = -1;
    private array $tableAnalysis = [];

    function __construct(Request $request) {
        parent::__construct($request);
        $this->addStylesheet("/css/admin/admin_header.css");
        $this->addStylesheet("/css/admin/store.css");
    }

    public function handleRequest(): void {
        $this->setIncludeFooter(false);
        $this->setIncludeCopyright(false);
        $this->setIncludeColumn1(false);
        $this->setIncludeColumn3(false);
        $this->setPageTitle("Store");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["action"] == "serialize") $this->serialize();
            if ($_POST["action"] == "try_deserialize") $this->showDeserialize = true;
            if ($_POST["action"] == "do_deserialize" && $_POST["submit"] == "Deserialize") $this->deserialize();
            if ($_POST["action"] == "analyze_tables") $this->analyzeTables();
        } else {
            $act = $this->getRequest()->getUrlPart(2);
            if ($act == "store.tar.gz") $this->downloadStore();
        }
    }

    #[NoReturn] private function downloadStore(): void {
        $this->setStopRender(true);
        $tmp_file = Env::dataDir() . "/tmp/store.tar";
        $dir = Env::dataDir() . "/store";
        $archive = new PharData($tmp_file);
        $archive->buildFromDirectory($dir);
        $archive->compress(Phar::GZ);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="store.tar.gz"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize("$tmp_file.gz"));
        readfile("$tmp_file.gz");
        unlink($tmp_file);
        unlink("$tmp_file.gz");
        exit();
    }

    private function serialize(): void {
        Log::info("Serializing Store");
        $pl = new ProgressListener("progress_store_s", array_sum($this->getSerializationStats()));
        $this->serializationResult = Store::serialize($pl);
        $this->serializationStats = null;
        $this->serializedRecordCount = $pl->getProgress();
        $pl->updateStatus([
            "total_" . self::ID_SERIALIZE => array_sum($this->getSerializationStats()),
            "progress_" . self::ID_SERIALIZE => $this->serializedRecordCount,
            "msg_" . self::ID_SERIALIZE => date("H:i:s", time())
                . " serialized $this->serializedRecordCount business objects to files",
        ]);
        $registry = Registry::actionRegistry();
        $registry->getActionByAcid("STORE_S")
            ->setLastModified($this->getRequest()->getSessionUser()->getName());
        $registry->persist();
        $this->setPageTitle("Store - serialized objects");
    }

    private function deserialize(): void {
        Log::info("Serializing Store");
        $pl = new ProgressListener("progress_store_d", array_sum($this->getStoreStats()));
        $this->storeResult = Store::deserialize($pl);
        $this->storeStats = null;
        $this->storedObjectCount = $pl->getProgress();
        $pl->updateStatus([
            "total_" . self::ID_DESERIALIZE => array_sum($this->getStoreStats()),
            "progress_" . self::ID_DESERIALIZE => $this->storedObjectCount,
            "msg_" . self::ID_DESERIALIZE => date("H:i:s", time())
                . " deserialized $this->storedObjectCount business objects from file",
        ]);
        $registry = Registry::actionRegistry();
        $registry->getActionByAcid("STORE_D")
            ->setLastModified($this->getRequest()->getSessionUser()->getName());
        $registry->persist();
        $this->setPageTitle("Store - deserialized files");
    }

    private function analyzeTables(): void {
        $this->tableAnalysis = Dao::analyzeTables();
    }

    /**
     * @return array<string, int>
     */
    public function getSerializationStats(): array {
        if (is_null($this->serializationStats)) $this->serializationStats = Store::serializationStats();
        return $this->serializationStats;
    }

    /**
     * @return array<string, int>
     */
    public function getSerializationResult(): array {
        return $this->serializationResult;
    }
    public function getSerializedRecordCount(): int {
        return $this->serializedRecordCount;
    }

    /**
     * @return array<string, int>
     */
    public function getStoreStats(): array {
        if (is_null($this->storeStats)) $this->storeStats = Store::storeStats();
        return $this->storeStats;
    }

    /**
     * @return bool
     */
    public function showDeserialize(): bool {
        return $this->showDeserialize;
    }

    /**
     * @return array
     */
    public function getStoreResult(): array {
        return $this->storeResult;
    }

    /**
     * @return int
     */
    public function getStoredObjectCount(): int {
        return $this->storedObjectCount;
    }

    /**
     * @return array
     */
    public function getTableAnalysis(): array {
        return $this->tableAnalysis;
    }


    public function renderHeader(): void {
        require_once Env::templatesDir() ."/admin/admin_header.php";
    }

    public function renderColumn2(): void {
        require_once Env::templatesDir() . "/admin/store/store.php";
    }

}