<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/13/17
 * Time: 6:00 PM
 */

namespace App\Services;


use App\Repositories\CourseRepository;

class CourseServiceFactory
{
    public static function create() {
        return new CourseService(new CourseRepository());
    }
}