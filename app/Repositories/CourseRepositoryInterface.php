<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/7/17
 * Time: 12:54 PM
 */

namespace App\Repositories;


interface CourseRepositoryInterface
{
    public function getAllCourses();

    public function getCourseCourseId($id);
}