<?php

namespace App\Models\AdminArchiveFile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserArchiveAccounts extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'ResidentUserArchived';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'mname',
        'lname',
        'suffix',
        'email',
        'password',
        'address',
        'usertype',
        'month',
        'day',
        'year',
        'gender',
        'residenttype',
        'age',
        'verificationInfo',
        'verification_id',
        'verification_id_number',
        'verification_id_image',
        'response',
        'personIncharge',
    ];
}
