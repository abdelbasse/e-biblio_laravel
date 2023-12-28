<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'tell',
        'profile_url',
        'email',
        'password',
        'org_password',
        'is_active',
        'parent_account',
        'is_admin',
        'background_account',
        'channel_name',
        'channel_desc',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // the books he post it (for account)
    public function books()
    {
        return $this->hasMany(Book::class, 'id_account');
    }

    public function accountes()
    {
        return $this->hasMany(User::class, 'parent_account');
    }

    public function lists()
    {
        return $this->hasMany(ListBook::class, 'id_account');
    }

    //function return the books he read (for user and account)
    public function ReadedBook()
    {
        return $this->belongsToMany(Book::class, 'table_read', 'id_user', 'id_book')->withPivot('created_at');
    }

    //function return the books he liked (for user and account)
    public function LikedBooks()
    {
        return $this->belongsToMany(Book::class, 'likes', 'idUser', 'idBook');
    }

    public function LikedList()
    {
        return $this->belongsToMany(ListBook::class, 'likes', 'idUser', 'idList');
    }

    //function return the books he Saved (for user and account)
    public function SavedBooks()
    {
        return $this->belongsToMany(Book::class, 'saved', 'idUser', 'idBook');
    }

    public function SavedList()
    {
        return $this->belongsToMany(ListBook::class, 'saved', 'idUser', 'idList');
    }
}
