<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function pageLoging()
    {
        return view('login');
    }

    public function auth_user(Request $req)
    {
        if ($req->type == 'log') {
            if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
                if (auth::user()->is_active == true) {
                    if (auth::user()->is_admin == true) {
                        return redirect()->route('home');
                    } elseif (auth::user()->is_account == true) {
                        return view('Users.playlist');
                    } else {
                        return view('Users.history');
                    }
                }else{
                    return redirect()->route('loging')->withErrors(['Ereur'=>'this account is not active anymore due to many many reports']);
                }
            }
        } else {
            if(User::where('email', $req->email)->orWhere('name',$req->name)->count() == 0){
                $user = User::create([
                    'name' => $req->name,
                    'last_name' => '',
                    'email' => $req->email,
                    'password' => Hash::make($req->password),
                    'org_password' => $req->password,
                    'tell'=>'',
                ]);
                auth()->login($user);
                return redirect()->route('home');
            }else{
                return redirect()->route('loging')->withErrors(['Ereur'=>'the user name or the eamil already existed ! ']);
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('loging');
    }
}
