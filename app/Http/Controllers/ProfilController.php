<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

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
        return redirect()->route('profil.profile')->with('success', 'Profile updated successfully.');

    }

    public function updateprofilview()
    {
        $user = Auth::user();
        // $roles = DB::table('master_roles')->get();

        return view('profil.editprofile', compact('user'));
    }

    public function changepass()
    {
        $user = Auth::user();

        return view('profil.changepassword', compact('user'));
    }

    public function changePassword(Request $request){

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);
        

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with('error','old password not match with your current password');
        }

        if ($request->new_password != $request->confirm_password) {
            return back()->with('error','new password and confirm password not match');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success','change password was successfully');
    }
//     {
//         $user = Auth::user();
//         $current_password = $request->current_password;
//         $new_password = Hash::make($request->new_password);
//         $confirm_password = $request->confirm_password;

//         $change_password= User::select('password')->where('id', $user->id)->first();

//         if(empty($request->current_password && $request->new_password && $request->confirm_password )) {
//             if($change_password == $current_password){
//                 if ($confirm_password == $new_password) {
//                     $update = User::where('id', $user->id)->update(['password' => $new_password]);
//                     if($update){
//                         return Redirect::back()->with(['success' => 'Password Berhasil Diubah']);
//                     } else {
//                         return Redirect::back()->with(['error' => 'Password Gagal Diubah']);
//                     }
//                 } else {
//                     return Redirect::back()->with(['warning','New Password dan Confirm Tidak Sama']);
//                 }
//             } else {
//                 return Redirect::back()->with(['warning','Password Salah']);
//             }
//         } else {
//             return Redirect::back()->with(['warning', 'Harap Mengisi Semua Field']);
//         }
//         // dd($change_password);

//         // // Memastikan pengguna terautentikasi
//         // $user = Auth::user();

//         // // Validasi input
//         // $request->validate([
//         //     'current_password' => 'required',
//         //     'new_password' => 'required|string|min:8|confirmed',
//         // ]);

//         // // Periksa apakah password saat ini cocok dengan password pengguna
//         // if (!Hash::check($request->current_password, $user->password)) {
//         //     return back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
//         // }

//         // // Update password pengguna
//         // $user->password = Hash::make($request->new_password);
//         // $user->save();

//         // return redirect()->route('profil.profile')->with('success', 'Password berhasil diubah.');
//     }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
