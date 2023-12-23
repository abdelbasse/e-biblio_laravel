<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function page()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $list = $user->accountes;
        return view('Users.profile')->with(['accounts' => $list]);
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
