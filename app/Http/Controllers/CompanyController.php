<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Mail\CompanyCreated;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $get_all_company = Company::orderBy('id', 'desc')->paginate('10');
            return view('companies', compact('get_all_company', 'request'));
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

            return view('add_company', compact('request'));
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
    public function store(StoreCompanyRequest $request)
    {
        try {
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $path = storage_path('app/public/company_logo');
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            if ($file = $request->file('company_logo')) {
                $fileName   = time() . $file->getClientOriginalName();
                $file->storeAs('company_logo', $fileName, 'public');
                $file_name  = $file->getClientOriginalName();
                $file_type  = $file->getClientOriginalExtension();
                $filePath   = $path . $fileName;

                $company->logo = $fileName;
            }
            $company->save();
            $details = [

                'title' => 'New Company Created',

                'body' => 'Company '.$company->name.' created.'

            ];
            Mail::to('ketan.barevadiya@gmail.com')->send(new CompanyCreated($details));
            $request->session()->flash('status', 'New company created successfully!');
            return redirect()->route('company.index');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        try {

            return view('show_company', compact('company'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company, Request $request)
    {
        try {

            return view('edit_company', compact('request', 'company'));
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, company $company)
    {
        try {

            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $path = storage_path('app/public/company_logo');
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            if ($file = $request->file('company_logo')) {
                $fileName   = time() . $file->getClientOriginalName();
                $file->storeAs('company_logo', $fileName, 'public');
                $file_name  = $file->getClientOriginalName();
                $file_type  = $file->getClientOriginalExtension();
                $filePath   = $path . $fileName;

                $company->logo = $fileName;
            }
            $company->save();
            $request->session()->flash('status', 'Company updated successfully!');
            return redirect()->route('company.index');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company, Request $request)
    {
        try {
            $company->delete();
            $request->session()->flash('status', 'Company deleted successfully!');
        } catch (\Exception $e) {
            echo  $e->getMessage();
            exit;
        }
    }
}
