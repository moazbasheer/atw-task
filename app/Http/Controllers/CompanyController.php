<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $fileName = null;
        if($request->logo) {
            $fileName = time().'_'.$request->logo->getClientOriginalName();
            $filePath = $request->logo->storeAs("public", $fileName);
        }
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $fileName,
            'website' => $request->website,
        ]);

        return redirect()->route('companies.create')->with(['success_message' => __('messages.success-company-add')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        if($request->logo) {
            $fileName = time() . '_' . $request->logo->getClientOriginalName();
            if($company->logo && file_exists(public_path('storage/' . $company->logo)) ) {
                unlink(public_path('storage/' . $company->logo));
            }
            $request->logo->storeAs('public', $fileName);
            $company->update([
                'logo' => $fileName
            ]);
        }
        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        return redirect()->route('companies.edit', $company->id)->with(['success_message' => __('messages.success-company-update')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if($company->logo && file_exists(public_path('storage/' . $company->logo))) {
            unlink(public_path('storage/' . $company->logo));
        }
        $company->delete();
        return back();
    }
}
