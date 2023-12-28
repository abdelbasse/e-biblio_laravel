<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';

    protected $fillable = [
        'idUser',
        'idBook',
        'idList',
        'created_at',
        'updated_at',
    ];
}
