<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct user list
    public function userList()
    {
        $users = User::where('role', 'user')
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
}
