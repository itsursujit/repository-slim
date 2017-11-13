<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/7/17
 * Time: 5:37 PM
 */

namespace App\Helpers;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class LogHelper
 * @package App\Helpers
 */
class LogHelper
{
    /**
     * @var Logger
     */
    static $log;

    /**
     *
     */
    public static function initiate() {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(LOG_PATH . "/" . LOG_FILE, Logger::WARNING));
        self::$log = $log;
    }
}