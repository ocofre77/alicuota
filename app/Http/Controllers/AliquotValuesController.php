<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\AliquotValue;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class AliquotValuesController extends Controller
{
    //
    public function index()
    {
      $alicuotValues =  AliquotValue::all();
      $alicuotValues->each(function($alicuotValue){
          $alicuotValue->propertyType;
      });
      return view("AliquotValues.index",compact('alicuotValues'));
    }

    public function create(){
      $propertyTypes = PropertyType::pluck('name','id');
      return view("AliquotValues.create",compact('propertyTypes'));
    }

    public function store(Request $request)
    {

      $validatedData = $request->validate([
          'property_type_id' => 'required',
          'value' => 'required|integer|between:1,50',
          'start_date' => 'required'
      ]);

      $aliquotValueFind = AliquotValue::where('property_type_id', $request->property_type_id)
      ->where('end_date',null)->first();

      $start_date = Carbon::parse($request->start_date);
      $start_date = $start_date->subDay($start_date->day - 1);
      //Grabar nueva
      $aliquotValue = new AliquotValue();
      $aliquotValue->start_date = $start_date;
      $aliquotValue->property_type_id = $request->property_type_id;
      $aliquotValue->value = $request->value;
      $aliquotValue->save();

      if($aliquotValueFind != null){
        if($aliquotValueFind->count() > 0 ){
          if($aliquotValueFind->start_date < $start_date){
              //Actualizamos anterior
              $end_date = $start_date->subDay(1);
              $aliquotValuePrevius = AliquotValue::find($aliquotValueFind->id);
              $aliquotValuePrevius->end_date = $end_date;
              $aliquotValuePrevius->save();
          }
        }
      }

      flash("Grabado correctamente")->success();

      return redirect()->route('AliquotValues.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aliquotValue = AliquotValue::find($id);//orderBy('id','desc');
        $aliquotValue->delete();
        flash('Se ha eliminado correctamente.', 'danger')->important();
        return redirect()->route('AliquotValues.index');
    }
}
