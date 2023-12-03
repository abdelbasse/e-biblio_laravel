<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //
    public function page()
    {
        return view('Users.profile');
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if (User::Where('name', $request->name)->get()->count() <= 1) {
            $user->update([
                'name' => $request->name,
                'tell' => $request->tell
            ]);
            // dd($request);
            return redirect()->route('profile');
        } else {

            return redirect()->route('profile')->withErrors(['Ereur' => 'This name or main already existed!']);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
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
    }
}
