<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use ValidatingModelTrait;

    protected $throwValidationExceptions = true;

    protected $fillable = [
      'name',
      'display_name',
      'description',
    ];
  
    protected $rules = [
      'name'      => 'required|unique:roles',
      'display_name'      => 'required|unique:roles',
    ];

}
