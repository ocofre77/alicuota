<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table ="periods";
    protected $fillable = ['year','month_id','month_name'];


    public function payments()
    {
      return $this-> hasMany ('App\Payment');
    }    

}
