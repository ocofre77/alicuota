<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonProperty extends Model
{
    use HasFactory;
    protected $table ="person_property";
    protected $fillable = [
        'person_id',
        'property_id',
        'data_from',
        'date_to',
        'owner',
    ];    
}
