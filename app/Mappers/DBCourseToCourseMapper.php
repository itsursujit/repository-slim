<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 4:54 PM
 */

namespace App\Mappers;


use App\Entities\CourseEntity;

class DBCourseToCourseMapper
{
    public static function map(array $result)
    {
        return new CourseEntity([
            'id' => $result['id'],
            'title' => $result['course_title'],
            'description' => $result['course_description'],
            'createdAt' => $result['created_at'],
            'updatedAt' => $result['updated_at'],
            'deletedAt' => $result['deleted_at'],
            'isDeleted' => $result['is_deleted'],
            'isLive' => $result['is_live'],
        ]);
    }
}