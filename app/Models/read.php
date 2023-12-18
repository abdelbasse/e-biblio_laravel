<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class read extends Model
{
    use HasFactory;
    protected $table = 'table_read';

    protected $fillable = [
        'id_user',
        'id_book',
        'created_at',
        'updated_at'
    ];

}
