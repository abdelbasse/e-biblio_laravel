<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categori;
use App\Models\Language;
use App\Models\Likes;
use App\Models\ListBook;
use App\Models\Saved;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Gestion User Liked and disliked post and History
    public function History()
    {
        $user = auth()->user();
        $allbooks = $user->ReadedBook()->orderBy('created_at', 'desc')->paginate(60);
        return view('Users.history', ['books' => $allbooks]);
    }

    public function SavedBooks_List()
    {
        $user = auth()->user();
        $books = $user->SavedBooks()->paginate(60);
        $lists = $user->SavedList()->paginate(60);
        return view('Saved&Liked', ['books' => $books, 'lists' => $lists, 'liked' => 0]);
    }

    public function LikedBooks_List()
    {
        $books = auth()->user()->LikedBooks()->paginate(60);
        $lists = auth()->user()->LikedList()->paginate(60);
        return view('Saved&Liked', ['books' => $books, 'lists' => $lists, 'liked' => 1]);
    }

    public function toggleSeriesLike($id)
    {
        $userId = auth()->user()->id;
        $like = Likes::where('idUser', $userId)->where('idList', $id)->count();

        // If the user has already liked the series, delete the like
        if ($like != 0) {
            DB::table('likes')
                ->where('idUser', $userId)
                ->where('idList', $id)
                ->delete();
            return redirect()->back()->with('success', 'Like removed successfully.');
        }

        // If the user hasn't liked the series yet, create a new like
        Likes::create([
            'idUser' => $userId,
            'idList' => $id,
        ]);

        return redirect()->back()->with('success', 'Series liked successfully.');
    }

    public function toggleSeriesSaved($id)
    {
        $userId = auth()->user()->id;
        $existingSaved = Saved::where('idUser', $userId)->where('idList', $id)->count();

        // If the user has already saved the series, delete the saved status
        if ($existingSaved != 0) {
            DB::table('saved')
                ->where('idUser', $userId)
                ->where('idList', $id)
                ->delete();
            return redirect()->back()->with('success', 'Saved status removed successfully.');
        }

        // If the user hasn't saved the series yet, create a new saved status
        Saved::create([
            'idUser' => $userId,
            'idList' => $id,
        ]);

        return redirect()->back()->with('success', 'Series saved successfully.');
    }

    public function saveLike($id)
    {
        $userId = auth()->user()->id;

        $existingLike = Likes::where('idUser', $userId)->where('idBook', $id)->count();

        if ($existingLike != 0) {
            DB::table('likes')
                ->where('idUser', $userId)
                ->where('idBook', $id)
                ->delete();
            return redirect()->back()->with('success', 'Like removed successfully.');
        }

        Likes::create([
            'idUser' => $userId,
            'idBook' => $id,
        ]);

        return redirect()->back()->with('success', 'Book liked successfully.');
    }

    public function saveSaved($id)
    {
        $userId = auth()->user()->id;

        $existingSaved = Saved::where('idUser', $userId)->where('idBook', $id)->count();
        if ($existingSaved != 0) {
            DB::table('saved')
                ->where('idUser', $userId)
                ->where('idBook', $id)
                ->delete();
            return redirect()->back()->with('success', 'Saved status removed successfully.');
        }

        Saved::create([
            'idUser' => $userId,
            'idBook' => $id,
        ]);

        return redirect()->back()->with('success', 'Book saved successfully.');
    }

    //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function page()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $list = $user->accountes;
        return view('Users.profile')->with(['accounts' => $list]);
    }

    public function GetAccountInfo($id)
    {
        $user = User::where('id', $id)->where('is_active', 1)->get();
        $books = Book::where('id_account', $id)->get();
        $lists = ListBook::where('id_account', $id)->get();
        return view('Users.account', ['user' => $user,'books'=>$books,'lists'=>$lists]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if (isset($request->type)) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ];

            try {
                $request->validate($rules);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->route('profile')->withErrors(['Ereur' => "input field is empty!"]);
            }

            if (User::where('name', $request->name)->orWhere('email', $request->email)->count() == 0) {
                User::create([
                    'name' => $request->name,
                    'tell' => null,
                    'last_name' => '',
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'org_password' => $request->password,
                    'parent_account' => auth()->user()->id,
                    'background_account' => 'images/backgroundProfile.png',
                ]);
                return redirect()->route('profile');
            } else {
                return redirect()->route('profile')->withErrors(['Ereur' => 'This name or email already existed!']);
            }
        } else {
            if (User::Where('name', $request->name)->count() == 0 || $user->name == $request->name) {
                if (auth()->user()->parent_account) {
                    if (User::Where('channel_name', $request->Chanelname)->count() == 0 || $user->channel_name == $request->Chanelname) {
                        $user->update([
                            'channel_name' => $request->Chanelname,
                            'channel_desc' => $request->chanelDesc
                        ]);
                    }
                }
                $user->update([
                    'name' => $request->name,
                    'tell' => $request->tell
                ]);
                return redirect()->route('profile');
            } else {
                return redirect()->route('profile')->withErrors(['Ereur' => 'This name already existed!']);
            }
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($request->type == "p") {
            $oldImageUrl = $user->profile_url;

            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust file validation rules
            ]);

            // Handle file upload
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $imageName);
                if ($oldImageUrl && $oldImageUrl !== 'icons/user.png') {
                    File::delete(public_path($oldImageUrl));
                }
                $user->update([
                    'profile_url' => 'images/users/' . $imageName, // adjust the column name accordingly
                ]);

                return response()->json(['message' => 'Profile image updated successfully']);
            }

            return response()->json(['error' => 'No file provided'], 400);
        } elseif ($request->type == "bg") {
            $oldImageUrl = $user->background_account;

            $request->validate([
                'backgroundFile' => 'required|image|mimes:jpeg,png,jpg|max:2048', // adjust file validation rules
            ]);

            // Handle file upload
            if ($request->hasFile('backgroundFile')) {
                $image = $request->file('backgroundFile');
                $imageName = $user->id . '_' . 'bg' . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/users'), $imageName);
                if ($oldImageUrl && $oldImageUrl !== 'images/backgroundProfile.png') {
                    File::delete(public_path($oldImageUrl));
                }
                $user->update([
                    'background_account' => 'images/users/' . $imageName, // adjust the column name accordingly
                ]);

                return response()->json(['message' => 'Profile image updated successfully']);
            }

            return response()->json(['error' => 'No file provided'], 400);
        }
    }
}
