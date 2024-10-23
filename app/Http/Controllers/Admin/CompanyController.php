<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Company::class);

        return view('admin.companies.index', ['companies' => auth()->user()->companies()->latest('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Company::class);

        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        Gate::authorize('create', Company::class);

        $request = $request->all();

        if (isset($request['logo'])) {
            $request['logo'] = request('logo')->store('companies', 'public');
            $request['logo'] = asset('storage/' . $request['logo']);
        }

        $request['slug'] = Str::slug(request('name'));

        auth()->user()->companies()->create($request);

        session()->flash('message', 'Your company has been created!');

        return redirect()->route('admin.companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        Gate::authorize('view', Company::class);

        return view('admin.companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        Gate::authorize('update', $company);

        return view('admin.companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        Gate::authorize('update', $company);

        $request = $request->all();
        $request['slug'] = Str::slug(request('name'));

        if (isset($request['logo'])) {
            $request['logo'] = $request['logo']->store('companies', 'public');
            $request['logo'] = asset('storage/' . $request['logo']);
        }

        $company->update($request);

        session()->flash('message', 'Your company has been updated!');

        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        Gate::authorize('delete', $company);

        $company->delete();

        session()->flash('message', 'Your company has been deleted!');

        return redirect()->route('admin.companies.index');
    }
}