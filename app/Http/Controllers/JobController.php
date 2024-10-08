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
        return view('jobs.index', ['jobs' => auth()->user()->jobs()->latest('id')->paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        if ($job->user()->isNot(auth()->user())) {
            abort(403);
        }

        return view('jobs.show', ['job' => $job]);
    }

}