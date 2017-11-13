<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 1:58 PM
 */

interface Repository
{

    function all();

    function findById($id);

    function find();

    function update();

    function insert();

    function delete();

    function query($sql);

    function getBuilder();

    function getBaseTable($repositoryString);

    function __toString();
}