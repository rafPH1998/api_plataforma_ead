<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;

class ReplySupportRepository 
{

    use RepositoryTrait;

    protected $model;

    public function __construct(ReplySupport $model)
    {
        $this->replySupport = $model;
    }

    public function createReplyToSupport(array $data)
    {
        $user = $this->getUserAuth();

        $reply =  $this->replySupport
                        ->create([
                            'support_id' => $data['support'],
                            'user_id' => $user->id,
                            'description' => $data['description'],
                        ]);

        return $reply;
    }



}