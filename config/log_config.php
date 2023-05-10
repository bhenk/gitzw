<?php

return [
    "log" => [
        "channel" => "log",
        "log_file" => "gitzwlog/logger.log",
        "log_max_files" => 5,
        "log_level" => \Psr\Log\LogLevel::DEBUG,
        "err_file" => "gitzwerr/error.log",
        "err_max_files" => 5,
        "err_level" => \Psr\Log\LogLevel::ERROR,
        "format" => "%level_name% | %datetime% | %message% | %context% %extra%\n",
        "date_format" => "Y-m-d H:i:s",
        "introspection" => true,
    ],
];
