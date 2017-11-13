<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/13/17
 * Time: 12:29 PM
 */


$app->route("GET", "/{id:[0-9]+}", "", \App\Controllers\Controller::class . "::get");
$app->route("GET", "/", "", \App\Controllers\Controller::class . "::get");