<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\EmployeeRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // paginating the employees list.
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // getting the companies from the database to choose from them.
        $companies = Company::get();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        // adding employee in the database.
        Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('employees.create')->with(['success_message' => __('messages.success-employee-add')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // getting companies from the database to choose from them.
        $companies = Company::get();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        // updating employee in the database.
        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company' => $request->company,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return back()->with(['success_message' => __('messages.success-employee-update')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // deleting the employee from the database.
        $employee->delete();
        return back();
    }
}
