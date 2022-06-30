<?php

namespace App\Http\Controllers;

use App\Models\kel_desa;
use App\Models\roles;
use App\Models\roleuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with('kelurahan')->get();
        $kelurahan = kel_desa::get();
        $role = Role::get();
        $userrole = roleuser::get();
        return view('admin.users.index', [
            "data" => $user,
            "kelurahan" => $kelurahan,
            "role" => $role,
            "userrole" => $userrole
        ]);
    }

    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->password = Hash::make($request->password);
        $user->id_kel_desa = $request->id_kel_desa;
        $user->save();

        if ($user) {
            $user->attachRole($request->role);
        }

        return redirect()->route('users');
    }

    public function update(Request $request, $id)
    {
        $user  = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_kel_desa = $request->id_kel_desa;
        $user->save();
        if ($user) {
            $user->attachRole($request->role);
        }
        return redirect()->route('users');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('users')->with('pesan', 'data Berhasil di Hapus');
    }
}