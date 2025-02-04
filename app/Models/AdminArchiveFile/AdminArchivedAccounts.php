<?php

namespace App\Models\AdminArchiveFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminArchivedAccounts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'mname',
        'lname',
        'suffix',
        'email',
        'usertype',
        'status',
        'personIncharge',
        'remove_at',
    ];
}
