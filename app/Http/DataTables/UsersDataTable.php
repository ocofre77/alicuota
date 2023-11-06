<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Period;
use App\Models\PersonType;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
            //->addColumn('action', 'usersdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $year = $this->request()->get('year');
        $personTypeId = $this->request()->get('person_type_id');

        $query = DB::table('payments')
            ->join('person_property', 'person_property.property_id', '=', 'payments.property_id')
            ->join('persons','persons.id','=','person_property.person_id')
            ->join('properties','properties.id','=','person_property.property_id')
            ->join('periods','periods.id','=','payments.period_id')
            ->join('person_types','person_types.id','=','persons.person_type_id')
            ->select(
                'persons.name as person_name',
                'persons.person_type_id',
                'person_types.name as person_type_name',
                'properties.lot_number',
                'payments.value',
                'periods.year',
                'periods.month_name');
        //        ->where('periods.year', '>', 0);

        if ($year) {
            $query = $query->where('periods.year', '=', $year);
        }

        if ($personTypeId) {
            $query = $query->where('persons.person_type_id', '=', $personTypeId);
        }

        //$payments = $query->get();

        return $this->applyScopes($query);
        //return $this->applyScopes($users);
        //return $model->newQuery()->select('id', 'add-your-columns-here', 'created_at', 'updated_at');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns( //$this->getColumns()
                [
                    ['data' => 'person_name', 'name' => 'persons.name', 'title' => 'Nombre Residente'],
                    ['data' => 'person_type_name', 'name' => 'person_types.name', 'title' => 'Tipo Residente'],
                    ['data' => 'lot_number', 'name' => 'properties.lot_number', 'title' => 'Lote'],
                    ['data' => 'value', 'name' => 'payments.value', 'title' => 'Valor'],
                    ['data' => 'year', 'name' => 'periods.year', 'title' => 'Año'],
                    ['data' => 'month_name', 'name' => 'periods.month_name', 'title' => 'Mes'],
                ]
            )
            ->minifiedAjax()
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'person_name',
            'person_type_name',
            'lot_number',
            'value',
            'year',
            'month_name'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pagos_' . date('YmdHis');
    }
}
