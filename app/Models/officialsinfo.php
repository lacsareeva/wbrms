<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class officialsinfo extends Model
{
  protected $table = 'officialsinfo'; 

  protected $fillable = [
      'fullname',
      'position',
      'officialsimage',
  ];
}
