<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Period;
use App\Models\Payment;
use App\Models\PersonProperty;
use App\Models\Condonation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CondonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request )
     {
      
       $lot_number = $request->lot_number;
       $document_number = $request->document_number;
       $name = $request->person_name;
        // $selected_period = $request->period_id;
        $properties = null;
        $payments = null;
        if($lot_number != null || $document_number != null || $name != null ){
            $properties= $this->GetProperties($lot_number,$document_number, $name);
            $payments = null;
            if($properties == null || $properties->count() == 0){
                flash("No se encontraron registros ")->warning();
            }
            else
            {
              if($properties->count() ==1){
                $payments=$this->GetPaymentsByPropertyId(
                    $properties->first()->id,
                    $properties->first()->person_id
                );
              }
              else{
                flash("Hay varias propiedades ")->warning();
              }
            }
        }

        $periods = $this->GetPeriods();
        $lot_number = $request->lot_number;
        $persons = Person::Search($request->name,$request->document_number,0)->paginate(4);
        return View(
            "Condonations.index",
            compact(
                'persons',
                'properties',
                'payments',
                'periods',
                'lot_number'
            ));
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $periods= $request->active;
      
        $totalcuotas = 0;

        //$strConsulta='select
       // lot_number, month_name, month_id,value,payment_value,
       // year, period_id
        //from paymentsview where value is not null  and property_id = ' . $request->property_id;
        
        //$payments = DB::select($strConsulta);

        //$strConsulta='select sum(value) as total
        //from paymentsview where value is not null  and property_id = ' . $request->property_id;
        //$totalPayments = DB::select($strConsulta);

        $totalcuotas= count($request->active);
        $condonationValue = $request->condonationValue;

        $cuotaAbono = round(($condonationValue / $totalcuotas),2);

        $valorAjuste = round($condonationValue - ($cuotaAbono * $totalcuotas),2);
        //dd($valorAjuste);

        // $result_value=DB::Table('properties')
        // ->join('aliquot_values','aliquot_values.property_type_id','=','properties.property_type_id')
        // ->select('aliquot_values.value')
        // ->where('properties.id','=',$request->property_id)
        // ->first();
        $transaction_id = time();

        $periods = $request->active;
        DB::beginTransaction();
        try{

          foreach ($periods as $period) {
            list($periodo_id,$valor_cuata) = (explode("-", $period));
              $valorCuotaAjuste = 0.0;
              if ($valorAjuste >0){
                $valorCuotaAjuste = round($cuotaAbono + 0.01,2);
                $valorAjuste = round($valorAjuste - 0.01,2);
              }
              else if ($valorAjuste < 0){
                $valorCuotaAjuste = round($cuotaAbono - 0.01,2);
                $valorAjuste = round($valorAjuste + 0.01,2);
              }
              else {
                $valorCuotaAjuste = $cuotaAbono;
              }
              $payment = new Payment();
              $payment->property_id = $request->property_id;
              $payment->user_id = \Auth::user()->id;
              $payment->transaction_id = $transaction_id;
              $payment->transaction_parent_id = 0;
              $payment->value = $valorCuotaAjuste;//$result_value->value;
              $payment->active = true;
              $payment->period_id =  $periodo_id;
              //dd($payment);
              $payment->save();

          }

          $condonation = new Condonation();
          $condonation->user_id = \Auth::user()->id;
          $condonation->transaction_id = $transaction_id;
          $condonation->note =$request->condonationReason;
          $condonation->value=$request->condonationValue;
          $condonation->save();

          flash("Pago Grabado correctamente. Transacción: ".$transaction_id)->success();
        }
        catch(Exception $ex)
        {
             DB::rollBack();
             flash('Condonación no fue Creada.', 'info')->important();
        }
        DB::commit();
        return redirect()->route('Condonations.index');
    }


    /**
     * @param  $lot_number [Número de Lote]
     */
    public function GetProperties($lot_number, $document_number, $name){

        $result_list=DB::Table('properties')
        ->join('property_types','property_types.id','=','properties.property_type_id')
        ->join('person_property','person_property.property_id','=','properties.id')
        ->join('persons','persons.id','=','person_property.person_id')
        ->select(
            'property_types.name as property_type_name',
            'properties.lot_number',
            'properties.id',
            'persons.name as person_name',
            'persons.id as person_id',
            'person_property.date_from',
            'person_property.date_to'
        )
        ->when($lot_number, function ($query) use ($lot_number) {
                    return $query->where('properties.lot_number', $lot_number);
        })
        ->when($document_number, function ($query) use ($document_number) {
                    return $query->where('persons.document_number', $document_number);
        })
        ->when($name, function ($query) use ($name) {
                    return $query->where('persons.name','like', "%".$name."%");
        })
        //->where('properties.lot_number','=',$lot_number)
        ->get();

        return $result_list;
    }

    public function GetPaymentsByPropertyId($property_id,$person_id){

      $strConsulta='select
          lot_number, month_name, month_id,value,payment_value,
          year, period_id
          from paymentsview';

      if( $person_id > 0 && $property_id > 0 ){
          $strConsulta .= ' where';

          if ($person_id > 0) {
              $strConsulta = $strConsulta . ' person_id = ' . $person_id;
          }
          if ($property_id > 0) {
              $strConsulta = $strConsulta . ' and property_id = ' . $property_id;
          }
      }

      $payments = DB::select($strConsulta);

      return $payments;
    }

    /*
    * Listado de periodos vigentes
    */
    function GetPeriods(){
        return Period::distinct()->pluck('year','year');
    }

}
