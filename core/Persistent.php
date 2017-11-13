<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/13/17
 * Time: 10:12 AM
 */

namespace Main;


interface Persistent
{
    public function getConnection();
}