<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\site\Request;
use function header;
use function http_response_code;
use function intval;
use function json_encode;
use function session_start;
use function session_status;
use function session_write_close;

readonly class AjaxResponse {

    function __construct(private Request $request) {
        $this->handle();
    }

    public function handle(): void {
        $act = $this->request->getUrlPart(1);
        if ($act == "progress") {
            $this->getProgress();
        } else {
            http_response_code(404);
        }

    }

    private function getProgress(): void {
        $id = $_REQUEST["id"] ?? false;
        if ($id) {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();
            $progress = $_SESSION["progress_$id"] ?? 0;
            $total = $_SESSION["total_$id"] ?? false;
            $msg = $_SESSION["msg_$id"] ?? "";
            session_write_close();
            if ($total) {
                http_response_code(200);
                echo json_encode([
                    "id" => $id,
                    "progress" => intval(($progress/$total) * 100),
                    "message" => $msg,
                ]);
                return;
            }
        }
        http_response_code(204);
    }

}