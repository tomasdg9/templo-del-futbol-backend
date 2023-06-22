<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function edit(string $id){
        $roles = Role::all();
        $user = User::find($id);
        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user){
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('info', 'Roles asignados correctamente');
    }
}
