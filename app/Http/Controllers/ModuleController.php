<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Repositories\ModuleRepository;
use App\Http\Resources\ModuleResource;

class ModuleController extends Controller
{
    protected $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

    public function index($idCourse) 
    {
        $m = $this->repository->getModulesByCourseId($idCourse);
        return ModuleResource::collection($m);
    }
}
