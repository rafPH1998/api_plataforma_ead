<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupport;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $supportRepository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request) 
    {
        $support = $this->repository->getSupports($request->all());
        return SupportResource::collection($support);
    }

    public function store(StoreSupport $request) 
    {
        $support = $this->repository->createNewSupport($request->validated());
        return new SupportResource($support);
    }

    public function mySupports(Request $request)
    {
        $mySupport = $this->repository->getMySupports($request->all());
        return SupportResource::collection($mySupport);
    }

}
