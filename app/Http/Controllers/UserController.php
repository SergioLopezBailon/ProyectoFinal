<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function perfil(){
        return view('user.perfil');
    }

    public function edit(User $user)
    {
        $payment=['PayPal','Bitcoin'];
        return view('user.edit',compact('user','payment'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$user->id"],
        ]);
        $user->update($request->all());
        return redirect()->route('user.perfil')->with('mensaje','Usuario modificado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home')->with('mensaje','Usuario borrado con éxito');
    }
}
