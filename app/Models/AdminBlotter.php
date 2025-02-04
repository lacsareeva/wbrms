<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminBlotter extends Model
{
    use HasFactory;

    protected $table = 'blotter';
    protected $fillable = [
      'incident_report',
      'address',
      'datetimes',
      'nameofcomplainant',
      'witness1',
      'witness2',
      'narrative',
      'sender'
    ];
}
