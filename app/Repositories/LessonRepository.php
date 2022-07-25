<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\View;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository 
{
    use RepositoryTrait;

    protected $model;
    protected $viewsLesson;

    public function __construct(Lesson $model, View $viewsLesson)
    {
        $this->lesson = $model;
        $this->$viewsLesson = $viewsLesson;
    }

    public function getAllLessonsByModuleId($moduleId)
    {
        //listando todas as aulas de um determinado modulo
        return $this->lesson
            ->where('module_id', $moduleId)
            ->get();
    }

    public function getLesson($id)
    {
        //listando todas uma aula especifica
        return $this->lesson->findOrFail($id);
    }

    //metodo para inserir uma visualizacao na aula
    public function markLessonViews(string $lessonId)
    {
        $user = $this->getUserAuth();

        $view = $user->views()->where('lesson_id', $lessonId)->first();

        if ($view) {
            return $view->update([
                'qtd' => $view->qtd + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $lessonId
        ]);

        
    }
}