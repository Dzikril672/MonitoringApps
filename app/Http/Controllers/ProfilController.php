<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

class ProfilController extends Controller
{
    public function profil()
    {
        $user = Auth::user();
        $role = null;

        if ($user->role) {
            $role = Role::find($user->role);
        }

        return view('profil.profile', compact('user', 'role'));
    }

    public function updateprofil(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update profil pengguna
        $user->name = $request->name;
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('profil.profile')->with('success', 'Profile updated successfully.');
    }

    public function updateprofilview()
    {
        $user = Auth::user();
        dd($user->role); // Uncomment this line to see the output

        // Load the 'role' relationship
        $user->load('role');
        $role = null;

        if ($user->role) {
            $role = Role::find($user->role);
        }

        return view('profil.editprofile', compact('user', 'role'));
    }

    public function changepass()
    {
        return view('profil.changepassword');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
