<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'book';

    protected $fillable = [
        'id',
        'Title',
        'desc',
        'nbrPage',
        'url_cover',
        'url_pdf',
        'is_valid',
        'id_list',
        'id_account',
        'created_at'
    ];

    public function list(){
        return $this->belongsTo(ListBook::class, 'id_list');
    }
}
