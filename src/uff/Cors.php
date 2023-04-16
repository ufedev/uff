<?php

namespace Uff;

/**
 * @author Malfasi Federico <federico.malfasi@gmail.com>
 */
final class Cors
{
    private static array $whiteList = [];
    private static ?string $msg;


    final public static function setCors(array $whiteList = [], string $msg = "denied"): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: *");
        self::$whiteList = $whiteList;
        self::$msg = $msg;
    }

    final public static function cors(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method !== "GET") {
            if (isset($_SERVER["HTTP_ORIGIN"])) {
                if (!in_array($_SERVER["HTTP_ORIGIN"], self::$whiteList)) {

                    echo json_encode(self::$msg, http_response_code(403));
                    exit;
                }
            } else {

                echo json_encode(self::$msg, http_response_code(403));
                exit;
            }
        }
    }
}
