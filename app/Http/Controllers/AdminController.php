<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function panel(){
        $users = User::all();
        $roles = ['admin','user'];
        return view('admin.panel',compact('users','roles'));
    }
    public function update(Request $request, User $user)
    {
        $rol = $request->rol;
        $user->update(['rol'=>$rol]);
        return redirect()->route('admin.panel')->with('mensaje','Rol cambiado con éxito');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.panel')->with('mensaje','Usuario borrado con exito');
    }
}
