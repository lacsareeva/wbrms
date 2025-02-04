<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRecords extends Model
{
    protected $table = 'records';
    protected $fillable = [
      'fullname',
      'age',
      'address',
      'purpose',
      'sender',
      'requirement',
      'requesttype',
      'status'
    ];
}
