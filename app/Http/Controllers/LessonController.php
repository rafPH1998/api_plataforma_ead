<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViews;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index($moduleId)
    {
        $lesson = $this->repository->getAllLessonsByModuleId($moduleId);
        return LessonResource::collection($lesson);
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLesson($id));
    }

    public function viewed(StoreViews $request)
    {
        $this->repository->markLessonViews($request->lesson);

        return response()->json(['success' => 'Aula visualizada!']);
    }
}
