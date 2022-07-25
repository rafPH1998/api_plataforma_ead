<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository 
{
    protected $entity;

    public function __construct(Module $entity)
    {
        $this->module = $entity;
    }

    public function getModulesByCourseId($idCourse) 
    {
        return $this->module
            ->where('course_id', $idCourse)
            ->get();
    }

}