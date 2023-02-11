<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // password change page
    public function passwordChangePage()
    {
        return view('admin.account.changePassword');
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
            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            // return redirect()->route('category#list');

            return back()->with(['changeSuccess' => 'Password Change Success']);
        }

        return back()->with(['notMatch' => 'The Old Password doesn\'t Match.Try Again!']);
    }

    // direct admin detail page
    public function detail()
    {
        return view('admin.account.detail');
    }

    // direct admin edit page
    public function edit()
    {
        return view('admin.account.edit');
    }

    // update account
    public function update($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    // admin list
    public function list()
    {
        $admin = User::when(request('key'), function ($query) {
            $query->orWhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%')
                ->orWhere('phone', 'like', '%' . request('key') . '%')
                ->orWhere('gender', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'admin')->paginate(3);

        $admin->appends(request()->all());

        return view('admin.account.list', compact('admin'));
    }

    // admin delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account Deleted...']);
    }

    // admin change role page
    public function changeRole($id)
    {
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    // change role
    public function change($id, Request $request)
    {
        // User::where('id', $id)->update(['role' => $request->role]);
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    // request user data
    private function requestUserData($request)
    {
        return [
            'role' => $request->role
        ];
    }

    // request user data
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    // account validation check
    private function accountValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',

        ])->validate();
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
