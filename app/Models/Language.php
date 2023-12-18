<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'table_language';

    protected $fillable = [
        'id',
        'language',
        'short',
        'created_at',
        'updated_at'
    ];
}
