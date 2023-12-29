<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function validHomePage()
    {
        $books = Book::where('is_valid', 0)->orderby('created_at', 'desc')->paginate(30);
        return view('Admin.ValideBook', ['books' => $books]);
    }


    public function validBookAction($id, $isValid)
    {
        $book = Book::find($id);

        if ($isValid == '1') {
            $book->update(['is_valid' => 1]);
        } else {
            $book->delete();
        }

        return redirect()->route('admin.book.valide');
    }

    public function usersListHomePage()
    {
        $users = User::whereNotNull('parent_account')->paginate(30);
        return view('Admin.UsersList', ['users' => $users]);
    }

    public function usersListUpdate($id, $isValid)
    {
        $user = User::find($id);

        if ($isValid == '0') {
            $user->update(['is_active' => 1]);
        } else {
            $user->update(['is_active' => 0]);
        }

        return redirect()->route('admin.users.list');
    }
}
