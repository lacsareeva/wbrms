<?php

namespace App\Models\AdminArchiveFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminArchiveBorrowed extends Model
{
    use HasFactory;
    protected $table = 'archivedBorrowed';
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
      'response',
      'returned_at',
      'personIncharge'
    ];
}
