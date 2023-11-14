<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AliquotValue extends Model
{
    use HasFactory;

    protected $table ="aliquot_values";
    protected $fillable = ['id',
        'value',
        'start_date',
        'end_date',
        'property_type_id',
    ];

    public function propertyType()
    {
        return $this->belongsTo('App\Models\PropertyType');
    }



}
