<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('companies.index', ['companies' => Company::query()->latest('id')->paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    public function showBySlug(string $slug, int $id)
    {
        $jobs = Job::query()->where('company_id', $id)->paginate(10);

        return view('companies.show', ['jobs' => $jobs]);
    }
}