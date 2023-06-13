<?php

namespace bhenk\gitzw\handle;

use bhenk\gitzw\model\ProgressListener;
use bhenk\gitzw\site\Request;
use function http_response_code;
use function intval;
use function json_encode;
use function session_start;
use function session_status;
use function session_write_close;

class AjaxResponse {


    public function updateStatus(array $args): void {
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        foreach ($args as $key => $value) {
            $_SESSION[$key] = $value;
        }
        session_write_close();
    }

    public function handle(Request $request): void {
        $act = $request->getUrlPart(1);
        if ($act == "progress") {
            $this->getProgress();
        } else {
            http_response_code(404);
            echo "Unknown resource: " . $request->getRawUrl();
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