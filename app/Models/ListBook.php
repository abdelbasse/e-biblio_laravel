<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBook extends Model
{
    use HasFactory;

    protected $table = 'book';

    protected $fillable = [
        'id',
        'Title',
        'desc',
        'id_account'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'id_list');
    }
}
