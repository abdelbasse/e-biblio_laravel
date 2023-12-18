<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categBelongToBook extends Model
{
    use HasFactory;
    protected $table = 'categ_belong_to_book';

    protected $fillable = [
        'idBook',
        'idCate',
        'created_at',
        'updated_at',
    ];
}
