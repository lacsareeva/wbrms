<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AdminBorrowed extends Model
{
    use HasFactory;
    protected $table = 'borrowed';
    protected $fillable = [
      'name',
      'address',
      'equipment',
      'quantity',
      'purpose',
      'contact',
      'borrow-date',
      'return-date',
      'sender',
      'status',
      'response'
    ];
}
