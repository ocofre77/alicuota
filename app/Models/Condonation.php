<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condonation extends Model
{
    use HasFactory;
    
    protected $table ="condonations";
    protected $fillable = [
        'user_id',
        'transaction_id',
        'note',
        'vaule'
  
        ];    
}
