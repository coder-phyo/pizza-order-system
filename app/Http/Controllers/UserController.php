<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct user list
    public function userList()
    {
        $users = User::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%')
                ->orWhere('address', 'like', '%' . request('key') . '%');
        })
            ->where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('admin.user.list', compact('users'));
    }

    // change user role with ajax
    public function changeRole(Request $request)
    {
        User::where('id', $request->id)->update([
            'role' => $request->role
        ]);
    }

    // delete user
    public function userDelete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Deleted Success...']);
    }
}
