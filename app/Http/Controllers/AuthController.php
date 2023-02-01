<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // direct login page
    public function loginPage()
    {
        return view('login');
    }

    // direct register page
    public function registerPage()
    {
        return view('register');
    }

    // direct dashboard page
    public function dashboard()
    {

        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
    }

    // password change page
    public function passwordChangePage()
    {
        return view('admin.password.change');
    }

    // change password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            Auth::logout();
            return redirect()->route('category#list');
        }

        return back()->with(['notMatch' => 'The Old Password doesn\'t Match.Try Again!']);
    }

    // password validation check
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
