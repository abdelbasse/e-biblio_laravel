<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ListBook;
use App\Models\Categori;
use App\Models\Language;
use App\Models\Likes;
use App\Models\read;
use App\Models\Readed;
use App\Models\Saved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class bookController extends Controller
{

    public function HomePage()
    {
        $books = Book::where('is_valid', true)->paginate(30);
        $lists = ListBook::paginate(30);
        return view('home', ['books' => $books, 'lists' => $lists]);
    }

    public function seriesInfo($id)
    {
        $tages = Categori::all();
        $lang = Language::all();
        $list = ListBook::find($id);
        $books = $list->books;
        $userLikedSeries = Likes::where('idUser', auth()->user()->id)->where('idList', $id)->count();
        $userSavedSeries = Saved::where('idUser', auth()->user()->id)->where('idList', $id)->count();

        return view('Comptes.playlist', [
            'tags' => $tages, 'langes' => $lang, 'list' => $list, 'books' => $books, 'userLikedSeries' => $userLikedSeries, 'userSavedSeries' => $userSavedSeries,
        ]);
    }

    public function bookInfo($id)
    {
        $book = Book::find($id);
        $result = DB::select("
            SELECT book.id, COUNT(categ_belong_to_book.idCate) as Totale
            FROM book, categ_belong_to_book
            WHERE
                book.id = categ_belong_to_book.idBook
                AND book.id <> " . $id . "
                AND categ_belong_to_book.idCate IN (
                    SELECT categ_belong_to_book.idCate
                    FROM categ_belong_to_book, book
                    WHERE book.id = categ_belong_to_book.idBook AND book.id = 1
                )
            GROUP BY book.id
            ORDER BY Totale LIMIT 15;
        ");
        $userLikedBook = Likes::where('idUser', auth()->user()->id)->where('idBook', $id)->count();
        $userSavedBook = Saved::where('idUser', auth()->user()->id)->where('idBook', $id)->count();

        $resultArray = [];
        foreach ($result as $row) {
            $extrabook = Book::find($row->id);
            $resultArray[] = $extrabook;
        }

        $read = Readed::where('id_user', auth()->user()->id)->where('id_book', $id)->count();
        if ($read == 0) {
            Readed::create([
                'id_user' => auth()->user()->id,
                'id_book' => $id,
            ]);
        }
        return view('Users.book', ['book' => $book, 'simeler' => $resultArray, 'userLikedBook' => $userLikedBook, 'userSavedBook' => $userSavedBook]);
    }

    public function openFile($id)
    {
        $book = Book::findOrFail($id);

        // Construct the file path using the url_pdf attribute
        $filePath = 'app/' . $book->url_pdf;

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $book->Title . '"',
        ];

        return response()->file(storage_path($filePath), $headers);
    }
}
