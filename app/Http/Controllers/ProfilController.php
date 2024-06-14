<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;

class ProfilController extends Controller
{
    public function profil()
    {
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            // Redirect to login page or show an error message
            return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
        }

        // Fetch the user's role information
        $role = DB::table('users as u')
            ->join('master_roles as mr', 'u.role', '=', 'mr.id_role')
            ->select('mr.nama_role')
            ->where('u.id', '=', $user->id)
            ->first();

        // Return the view with the user and role data
        return view('profil.profile', compact('user', 'role'));
    }

    public function updateprofil(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the user's name and role
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        // Optionally, you can flash a success message
        return redirect()->route('profil.editprofile')->with('success', 'Profile updated successfully.');

    }

    public function updateprofilview()
    {
        $user = Auth::user();
        // $roles = DB::table('master_roles')->get();

        return view('profil.editprofile', compact('user'));
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
