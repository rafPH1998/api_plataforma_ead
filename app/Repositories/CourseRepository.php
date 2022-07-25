<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository 
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->course = $model;
    }

    public function getAllCourses(){
        return $this->course->get();
    }

    public function getCourse($id){
        return $this->course->findOrFail($id);
    }
}