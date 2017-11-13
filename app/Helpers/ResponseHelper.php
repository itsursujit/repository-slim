<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 5:18 PM
 */

namespace App\Helpers;


class ResponseHelper
{
    /**
     * @param $jsonEncodedString
     */
    public static function toJson($jsonEncodedString)
    {
        header('Content-Type: application/json');
        echo($jsonEncodedString);
        exit;
    }
}