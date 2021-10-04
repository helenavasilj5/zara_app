<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    private $roles = array('admin', 'employee', 'user');

    public function getUsers ()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    public function editUser ($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself');
        }
        return view('admin.users.edit')->with([ 'user' => User::findOrFail($id),'roles' => $this->roles]);

    }

    public function updateUser (Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'You have successfully added a role');
        
    }

    public function deleteUser ($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself');
        }
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('admin.users.index')->with('success', 'You have successfully deleted a user');
        }
        return redirect()->route('admin.users.index')->with('error', 'You not deleted a user');
    }
}
