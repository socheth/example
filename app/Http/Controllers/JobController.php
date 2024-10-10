<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jobs.index', ['jobs' => Job::query()->latest('id')->latest('id')->paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function showBySlug(string $slug, int $id)
    {
        $job = Job::query()->findOrFail($id);

        return view('jobs.show', ['job' => $job]);
    }

}