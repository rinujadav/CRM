<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $get_all_employee = Employee::with('company_details')->orderBy('id', 'desc')->paginate('10');
            return view('employees', compact('get_all_employee', 'request'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $companies = Company::get();
            return view('add_employee', compact('request','companies'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = new Employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->company = $request->company;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();
            $request->session()->flash('status', 'New employee created successfully!');
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        try {
            $companies = Company::get();
            return view('show_employee', compact('employee','companies'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee,Request $request)
    {
        try {
            $companies = Company::get();
            return view('edit_employee', compact('request', 'employee','companies'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, employee $employee)
    {
        try {
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->company = $request->company;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();
            $request->session()->flash('status', 'Employee updated successfully!');
            return redirect()->route('employee.index');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee,Request $request)
    {
        try {
            $employee->delete();
            $request->session()->flash('status', 'Employee deleted successfully!');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }
}
