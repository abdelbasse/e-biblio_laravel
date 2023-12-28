<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\categBelongToBook;
use App\Models\Categori;
use App\Models\Language;
use App\Models\ListBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function home()
    {
        $tages = Categori::all();
        $lang = Language::all();
        $books = Book::where('id_account', auth()->user()->id)->Where('id_list', null)->get();
        $listbooks = ListBook::where('id_account', auth()->user()->id)->get();
        return view('Comptes.account', ['tags' => $tages, 'langes' => $lang, 'books' => $books, 'lists' => $listbooks]);
    }


    public function AddToAccount(Request $request)
    {
        if ($request->type == "no") {
            try {
                $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                ]);
                if (ListBook::where(['Title' => $request->title])->get()->count() != 0) {
                    return response()->json([
                        'message' => 'Form not completed',
                        'success' => false,
                    ]);
                }

                ListBook::create([
                    'Title' => $request->title,
                    'id_account' => auth()->user()->id,
                    'desc' => $request->description,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Form not completed',
                    'success' => false,
                ]);
            }

            return response()->json([
                'message' => 'Create Series successfully'
            ]);
        } elseif ($request->type == "ok") {
            try {
                $request->validate([
                    'language_id' => 'required',
                    'title' => 'required',
                    'pdf_file' => 'required|mimes:pdf|max:20480', // Max file size is 10 MB
                ]);
                if (!$request->has(['language_id', 'title', 'pdf_file'])) {
                    return response()->json([
                        'message' => 'Form not completed',
                        'success' => false,
                    ]);
                }
                $userName = auth()->user()->name;

                $userFolder = 'Accounts/' . $userName;
                if (!Storage::exists($userFolder)) {
                    Storage::makeDirectory($userFolder);
                }

                $bookTitle = $request->title;

                // Create a folder for the book using the book title and current timestamp
                $bookFolder = $userFolder . '/' . $bookTitle . '_' . time();
                Storage::makeDirectory($bookFolder);

                $pdfPath = $request->file('pdf_file')->storeAs($bookFolder, 'pdf_' . $bookTitle . '.pdf');


                $coverImage = $request->file('book_cover');

                // Check if the user provided a cover image
                if ($coverImage) {
                    $extension = $coverImage->getClientOriginalExtension();
                    $coverImagePath = $coverImage->storeAs($bookFolder, 'cover_' . $bookTitle . '.' . $extension);
                } else {
                    $coverImagePath = 'images/default book.jpg';
                }

                $book = Book::create([
                    'Title' => $request->input('title'),
                    'desc' => $request->input('description'),
                    'id_account' => auth()->user()->id,
                    'id_lang' => $request->language_id,
                    'url_cover' => $coverImagePath,
                    'url_pdf' => $pdfPath,
                    'nbrPage' => 0
                ]);

                $tagIds = json_decode($request->input('tag_ids'));

                foreach ($tagIds as $tagId) {
                    categBelongToBook::create([
                        'idBook' => $book->id,
                        'idCate' => $tagId,
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Form not completed',
                    'success' => false,
                ]);
            }

            return response()->json([
                'message' => 'Create Book successfully'
            ]);
        } elseif ($request->type == "list") {
            try {
                $request->validate([
                    'language_id' => 'required',
                    'title' => 'required',
                    'pdf_file' => 'required|mimes:pdf|max:20480', // Max file size is 10 MB
                ]);
                if (!$request->has(['language_id', 'title', 'pdf_file'])) {
                    return response()->json([
                        'message' => 'Form not completed',
                        'success' => false,
                    ]);
                }
                $userName = auth()->user()->name;

                $userFolder = 'Accounts/' . $userName;
                if (!Storage::exists($userFolder)) {
                    Storage::makeDirectory($userFolder);
                }

                $bookTitle = $request->title;
                $list = ListBook::find($request->list_id);
                // Create a folder for the book using the book title and current timestamp

                $bookFolder = $userFolder . '/list_' . $list->Title . '/' . $bookTitle . '_' . time();
                Storage::makeDirectory($bookFolder);

                $pdfPath = $request->file('pdf_file')->storeAs($bookFolder, 'pdf_' . $bookTitle . '.pdf');


                $coverImage = $request->file('book_cover');

                // Check if the user provided a cover image
                if ($coverImage) {
                    $extension = $coverImage->getClientOriginalExtension();
                    $coverImagePath = $coverImage->storeAs($bookFolder, 'cover_' . $bookTitle . '.' . $extension);
                } else {
                    $coverImagePath = 'images/default book.jpg';
                }

                $book = Book::create([
                    'Title' => $request->input('title'),
                    'desc' => $request->input('description'),
                    'id_account' => auth()->user()->id,
                    'id_lang' => $request->language_id,
                    'url_cover' => $coverImagePath,
                    'url_pdf' => $pdfPath,
                    'nbrPage' => 0,
                    'id_list' => $request->list_id
                ]);

                $tagIds = json_decode($request->input('tag_ids'));

                foreach ($tagIds as $tagId) {
                    categBelongToBook::create([
                        'idBook' => $book->id,
                        'idCate' => $tagId,
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Form not completed',
                    'success' => false,
                ]);
            }

            return response()->json([
                'message' => 'Create Book successfully'
            ]);
        }
    }
}
