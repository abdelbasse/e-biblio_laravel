<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    use HasFactory;
    protected $table = 'table_categori';

    protected $fillable = [
        'id',
        'libelle',
        'created_at',
        'updated_at'
    ];
}
