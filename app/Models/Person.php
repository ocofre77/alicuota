<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //use HasFactory;

    protected $table ="persons";
    protected $fillable = ['name','document_number','phone','cell_phone','address','start_date','user_id','person_type_id'];

    public function PersonType()
    {
        return $this->belongsTo('App\Models\PersonType');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function properties()
    {
        return $this->belongsToMany('App\Models\Property')->using('App\Models\PersonProperty');
    }

    public function  scopeSearch($query,$name,$document_number,$person_type_id)
    {
        //dd($person_type_id);
        if ( $name != null && $person_type_id ==null && $document_number==null){
           $query =  $query->Where('name','LIKE',"%$name%");
        }

        if ( $name == null && $person_type_id !=null && $document_number==null){
            $query =  $query->Where('person_type_id','=',$person_type_id);
        }

        if ( $name == null && $person_type_id ==null && $document_number!=null){
           $query = $query->Where('document_number','LIKE',"$document_number%");
        }

    }



}
