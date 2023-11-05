<?php

namespace App\Http\Controllers;
use App\Models\Periods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $periods = DB::table('periods')->select('year')->distinct()->orderBy('year','asc')->get();
        //dd($periods);
        return View("Periods.index",compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $year = DB::table('periods')->max('year');
      $year=$year+1;

      $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

      $periodsNew=[];
          $index = 0;
          foreach ($months as $month) {
              array_push(
                  $periodsNew,
                  array(
                      'year'=> $year,
                      'month_id' => $index + 1, 'month_name' => $months[$index],
                      'created_at'=>date("Y-m-d H:i:s")
                  )
              );
              $index++;
          }

      DB::Table('periods')->insert($periodsNew);

      $periods = DB::table('periods')->select('year')->distinct()->orderBy('year','asc')->get();

      flash("Se agrego un periodo correctamente")->success();
      //dd($periods);
      return View("Periods.index",compact('periods'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
