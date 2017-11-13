<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 2:39 PM
 */

namespace App\Repositories;


use App\Entities\CourseEntity;
use Main\Managers\DbConnectionManager;
use App\Mappers\DBCourseToCourseMapper;
use Main\MySQLPersistent;
use Main\Persistent;

class CourseRepository extends DbConnectionManager implements CourseRepositoryInterface
{
    protected $baseTable = "courses";

    public function __construct()
    {
        parent::__construct($this);
    }

    public function getAllCourses()
    {
        $dbCourses = $this->all();
        if(empty($dbCourses)) {
            return null;
        }
        $courses = [];
        foreach($dbCourses as $key => $course) {
            $courses[] = DBCourseToCourseMapper::map($course);
        }
        return $courses;
    }

    public function getCourseCourseId($id)
    {
        $dbCourse = $this->findById($id);

        if(empty($dbCourse)) {
            return null;
        }

        return DBCourseToCourseMapper::map($dbCourse);
    }

    public function __toString()
    {
        if(!empty($this->baseTable)) {
            return $this->baseTable;
        }

        return __CLASS__;
    }
}