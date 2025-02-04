<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminAnnouncement extends Model
{
use HasFactory;

protected $table = 'announcements';
    protected $fillable = [
      'title',
      'what',
      'when',
      'where',
      'otherInfo'
    ];
}
