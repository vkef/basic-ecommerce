<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ChangePass extends Controller
{
    public function ChangePassword(){

        return view('admin.body.change_password');

    }

    public function UpdatePassword(Request $request){

        $validateData = $request-> validate([

            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword )){

            $user = User::find(Auth::id());
            $user -> password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Success Password Change');
        }
        else{
            return redirect()->back()->with('error', 'Invalid Password');

        }
    }
}
