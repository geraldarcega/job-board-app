<?php

namespace App\Http\Controllers;

use App\Actions\CreateJobPost;
use App\Http\Requests\StoreJobPostRequest;
use App\Models\JobPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JobController extends Controller
{
    public function __construct(private $createJobPost = new CreateJobPost())
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(JobPost::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobPostRequest $request): Response
    {
        $this->createJobPost->handle($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job): Response
    {
        return response()->json($job);
    }
}
