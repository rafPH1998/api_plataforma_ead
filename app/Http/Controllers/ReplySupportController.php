<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplySupport;
use App\Http\Resources\ReplyResource;
use App\Repositories\ReplySupportRepository;
use Illuminate\Http\Request;

class ReplySupportController extends Controller
{
    protected $replySupportRepository;

    public function __construct(ReplySupportRepository $replySupportRepository)
    {
        $this->repository = $replySupportRepository;
    }

    public function createReplies(StoreReplySupport $request) 
    {
        $reply = $this->repository->createReplyToSupport($request->validated());
        return new ReplyResource($reply);
    }
}
