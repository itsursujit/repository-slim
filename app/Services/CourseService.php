<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 12:11 PM
 */

namespace App\Services;

use App\Entities\CourseEntity;
use App\Managers\DbConnectionManager;
use App\Mappers\DBCourseToCourseMapper;
use App\Repositories\CourseRepository;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\Repository;


class CourseService implements Service
{
    protected $baseTable = "courses";

    public $courseRepository;
    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }


    public function getAllCourses()
    {
        return $this->courseRepository->getAllCourses();
    }

    public function getCourseCourseId($id)
    {
        return $this->courseRepository->getCourseCourseId($id);
    }

}