<?php

namespace App\Http\Controllers;

use App\Actions\CreateJobPost;
use App\Http\Requests\StoreJobPostRequest;
use App\Models\JobPost;
use App\Services\ExternalJobPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;

class JobController extends Controller
{
    public function __construct(private ExternalJobPostService $externalJobPostService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("JobListing", [
            'jobs' => JobPost::with(relations: 'externalDetails')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobPostRequest $request, CreateJobPost $createJobPost)
    {
        $createJobPost->handle($request->validated());

        return to_route('jobs.create')->with('success', 'Job post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $job)
    {
        return Inertia::render("JobDetails", [
            'job' => $job->load( 'externalDetails')
        ]);
    }

    public function create()
    {
        return Inertia::render("JobForm");
    }

    public function approve(JobPost $job)
    {
        $job->is_approved = true;
        $job->save();

        return Inertia::render("JobApproval", [
            'job' => $job
        ]);
    }

    public function markAsSpam(JobPost $job)
    {
        $job->is_approved = false;
        $job->is_spam = true;
        $job->save();

        return Inertia::render("JobApproval", [
            'job' => $job
        ]);
    }
}
