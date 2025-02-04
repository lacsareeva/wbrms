<?php


namespace App\Models\AdminArchiveFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AdminArchivedBlotter extends Model
{
    use HasFactory;

    protected $table = 'archivedBlotter';
    protected $fillable = [
      'incident_report',
      'address',
      'datetimes',
      'nameofcomplainant',
      'witness1',
      'witness2',
      'narrative',
      'sender',
      'settled_at',
      'personIncharge'
    ];
}
