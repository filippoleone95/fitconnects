<?php

namespace FitConnects\Log;

require_once __DIR__ . '/../vendor/autoload.php';


use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerUtil
{
    private static $logger;

    public static function getLogger()
    {
        if (!isset(self::$logger)) {
            self::$logger = new Logger('fitconnects');
            $handler = new StreamHandler(__DIR__ . "/debug.log", Level::Debug);
            self::$logger->pushHandler($handler);
        }
        return self::$logger;
    }
}
