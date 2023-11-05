<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $companies =  Company::all();
      if($companies->count()==0){

        $new_conpany = new Company();
        $new_conpany->name="Mi Condominio";
        $new_conpany->ruc="1234567896541";
        $new_conpany->email="micondominio@example.com";
        $new_conpany->phone="023333333";

        $new_conpany->save();

         $companies =  Company::all();
        return view("Companies.index",compact('companies'));

      }

      return view("Companies.index",compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('Companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //$customer->name = $request->name;
      $company = Company::find($id);
      $company->fill($request->all());
      $company->save();
      flash("Grabado correctamente")->success();
      return redirect()->route('Companies.index');
    }


}
