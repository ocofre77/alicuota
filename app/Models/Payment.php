<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table ="payments";
    protected $fillable = ['property_id','user_id,value','user_id'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function period()
    {
        return $this->hasOne('App\Period');
    }    
}
