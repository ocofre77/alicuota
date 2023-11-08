<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table ="properties";
    protected $fillable = [
        'lot_number',
        'note',
        'address',
        'acive',
        'property_type_id',
        'person_id'];


    public function persons()
    {
        return $this->belongsToMany('App\Person');
    }

    public function property_type()
    {
        return $this->belongsTo('App\Models\PropertyType');
    }


    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function  scopeSearchByLotNumber($query,$lot_number)
    {
        $query =  $query->Where('lot_number','=',$lot_number);
        return $query;
    } 
}
