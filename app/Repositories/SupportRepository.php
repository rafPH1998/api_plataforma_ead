<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\RepositoryTrait;

class SupportRepository 
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Support $model)
    {
        $this->support = $model;
    }

    //metodo para pegar supports de usuario autenticado
    public function getMySupports($filter = [])
    {
        $filter['user'] = true;
        return $this->getSupports($filter);
    }

    public function getSupports(array $filter = [])
    {
        return $this->support
                    ->where(function ($query) use ($filter) {
                        if (isset($filter['lesson'])) {
                            $query->where('lesson_id', $filter['lesson']);
                        }

                        if (isset($filter['status'])) {
                            $query->where('status', $filter['status']);
                        }

                        if (isset($filter['filter'])) {
                            $filter = $filter['filter'];
                            $query->where('description', 'LIKE', "%{$filter}%");
                        }

                        if (isset($filter['user'])) {
                            $user = $this->getUserAuth();
                            $query->where('user_id', $user->id);
                        }
                    })
                    ->orderBy('updated_at', 'DESC')
                    ->get();
    }

    public function createNewSupport(array $data): Support
    {
        $support = $this->getUserAuth()
                        ->supports()
                        ->create([
                            'lesson_id' => $data['lesson'],
                            'status' => $data['status'],
                            'description' => $data['description'],
                        ]);

        return $support;
    }

    public function getSupport(string $idSupport)
    {
        return $this->replySupport->findOrFail($idSupport);
    }


}