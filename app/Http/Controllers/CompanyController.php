<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Company::query();

            foreach ($request->input('order') as $order) {
                $query->orderBy($order['column_name'], $order['dir']);
            }

            $companies = $query->paginate(10);

            return response()->json($companies, 200);
        }

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        if ($request->hasFile('logo'))
            $path = 'storage/'.$request->logo->store('images', 'public');

        $company = Company::create($request->except('logo'));
        $company->logo = $path??null;
        $company->save();
        
        return redirect()->route('companies.index')->with('message',__('Company added Successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @param  \App\Models\Company  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $company->update($request->except('logo'));

        if ($request->hasFile('logo')){
            $path = 'storage/'.$request->logo->store('images', 'public');
            $company->logo = $path;
        }
        
        $company->save();

        return redirect()->route('companies.index')->with('message',__('Company updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);  
        $company->delete();

        return redirect()->route('companies.index')->with('message', __('Company deleted'));
    }
}
