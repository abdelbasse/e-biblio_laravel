<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;
    protected $table = 'saved';

    protected $fillable = [
        'idUser',
        'idBook',
        'idList',
        'created_at',
        'updated_at',
    ];
}
