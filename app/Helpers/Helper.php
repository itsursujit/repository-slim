<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 2:05 PM
 */

namespace App\Helpers;


interface Helper
{
    public static function get($key);

    public static function set($key, $value);
}