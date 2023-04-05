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
        $companies = Company::paginate(10); // paginating the companies list.
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
        // saving the logo in the file system
        if($request->logo) {
            $fileName = time().'_'.$request->logo->getClientOriginalName();
            $filePath = $request->logo->storeAs("public", $fileName);
        }
        // adding the company in database
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
        // handling the new image in the file system and remove the old image if it exists
        if($request->logo) {

            if($company->logo && file_exists(public_path('storage/' . $company->logo)) ) {
                unlink(public_path('storage/' . $company->logo));
            }
            $fileName = time() . '_' . $request->logo->getClientOriginalName();
            $request->logo->storeAs('public', $fileName);
            $company->update([
                'logo' => $fileName
            ]);
        }
        // updating company in database.
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
        // handling removing the logo from file system.
        if($company->logo && file_exists(public_path('storage/' . $company->logo))) {
            unlink(public_path('storage/' . $company->logo));
        }
        $company->delete();
        return back();
    }
}
