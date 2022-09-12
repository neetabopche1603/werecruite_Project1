<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Show All company Tbl Function
    public function company()
    {
        $companyData = Company::get();
        return view('admin.company.index',compact('companyData'));
    }

    // Company Add Form Function
    public function CompanyAddView()
    {
        return view('admin.company.add');
    }

    // Company Store Function
    public function companyStore(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required',
        ]);

        $jobStore = new Company();
        $jobStore->company_name = $request->company_name;
        $jobStore->save();

        return redirect()->route('admin.company')->with('success', 'Company Create Successfully.....!');
    }

    // Company Edit Form Function
    public function CompanyEdit($id)
    {
        $companys = Company::find($id);
        return view('admin.company.edit', compact('companys'));
    }

    // Company Update Function
    public function companyUpdate(Request $request)
    {
        $jobStore = Company::find($request->id);
        $jobStore->company_name = $request->company_name;
        $jobStore->update();

        return redirect()->route('admin.company')->with('success', 'Company Update Successfully.....!');
    }
    // Company Delete Function
    public function companyDelete($id)
    {
        $companyDelete = Company::find($id)->delete();
        return redirect()->route('admin.company')->with('delete', 'Company Deleted Successfully.....!');
    }
}
