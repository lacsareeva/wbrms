<?php

namespace App\Models\AdminArchiveFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AdminArchivedRecords extends Model
{
    use HasFactory;
    protected $table = 'archivedRecords';
    protected $fillable = [
      'fullname',
      'age',
      'address',
      'purpose',
      'sender',
      'requirement',
      'requesttype',
      'status',
      'response',
      'personIncharge',
      'remove_at'
    ];
}
