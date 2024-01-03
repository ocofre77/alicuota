<?php

namespace App\DataTables;

use App\Models\User;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class PaymentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'users.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $year = $this->request()->get('year');
        $personTypeId = $this->request()->get('person_type_id');

        $query = DB::table('payments_views')->select(
         'lot_number','year','person_type_name','person_name','date_from','date_to',
          'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC','TOTAL'
        );


        $query = DB::select("select 
            'lot_number','yer','person_type_name','person_name','date_from','date_to',
             'ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC','TOTAL' from payments_views "
           );

        dd($query);   

        // if ($year) {
        //     $query = $query->where('year', '=', $year);
        // }
        // if ($personTypeId) {
        //     $query = $query->where('person_type_id', '=', $personTypeId);
        // }



        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payments-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        // return [
        //     Column::computed('action')
        //           ->exportable(false)
        //           ->printable(false)
        //           ->width(60)
        //           ->addClass('text-center'),
        //     Column::make('id'),
        //     Column::make('add your columns'),
        //     Column::make('created_at'),
        //     Column::make('updated_at'),
        // ];

        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),   
            Column::make('lot_number')->title('Lote'),
            Column::make('year')->title('Año'),
            Column::make('person_name')->title('Nombre Persona'),
            Column::make('date_from')->title('Desde'),
            Column::make('date_to')->title('Hasta'),
            Column::make('ENE')->title('ENE'),
            Column::make('FEB')->title('FEB'),
            Column::make('MAR')->title('MAR'),
            Column::make('ABR')->title('ABR'),
            Column::make('MAY')->title('MAY'),
            Column::make('JUN')->title('JUN'),
            Column::make('JUL')->title('JUL'),
            Column::make('AGO')->title('AGO'),
            Column::make('SEP')->title('SEP'),
            Column::make('OCT')->title('OCT'),
            Column::make('NOV')->title('NOV'),
            Column::make('DIC')->title('DIC'),
            Column::make('TOTAL')->title('TOTAL'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payments_' . date('YmdHis');
    }
}
