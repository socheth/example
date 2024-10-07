<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'salary' => 'required|numeric|max:50000',
        ]);

        auth()->user()->jobs()->create($request);

        session()->flash('message', 'Your job has been created!');

        return to_route('admin.jobs.index');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        if ($job->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'max:255'],
            'salary' => 'required|numeric|max:50000',
        ]);

        $job->update($request->all());

        session()->flash('message', 'Your job has been updated!');

        return to_route('admin.jobs.index', ['job' => $job]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if ($job->user_id !== auth()->user()->id) {
            abort(403);
        }

        $job->delete();

        session()->flash('message', 'Your job has been deleted!');

        return to_route('admin.jobs.index');
    }
}