<?php

namespace App\Models\AdminArchiveFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AdminArchiveAnnouncement extends Model
{
    use HasFactory;
    protected $table = 'archivedAnnouncements';
    protected $fillable = [
        'title', 
        'what', 
        'when', 
        'where', 
        'otherInfo', 
        'deleted_at'
    ];

}
