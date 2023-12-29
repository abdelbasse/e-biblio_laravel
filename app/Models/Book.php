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
        'created_at',
        'id_lang'
    ];

    public function list(){
        return $this->belongsTo(ListBook::class, 'id_list');
    }

    //get the categori of a book
    public function category()
    {
        return $this->belongsToMany(Categori::class,'categ_belong_to_book', 'idBook','idCate');
    }

    public function language(){
        return $this->belongsTo(Language::class, 'id_lang');
    }

    //function return the books he read (for user and account)
    public function readBy()
    {
        return $this->belongsToMany(User::class, 'table_read', 'id_book', 'id_user');
    }

    public function account(){
        return $this->belongsTo(User::class, 'id_account');
    }

    //function return the books he read (for user and account)
    public function LikedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'idBook', 'idUser')->onDelete('cascade');
    }

}
