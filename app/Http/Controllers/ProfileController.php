<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Pengguna;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages/profile/index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = str()->slug($request->name . '-' . time()) . '.' . $image->getClientOriginalExtension();
                $request->image = $image->storeAs('profile', $imageName);

            }

            // dont request foto if not change
            if (!$request->hasFile('image')) {
                unset($request->image);
            }

            // if image not null old image delete
            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::delete($user->image);
                }
            }

        if (Auth::user()->role == 'user') {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'image' => 'image|mimes:jpeg,png,jpg|max:3072',
                'no_ktp' => 'required|string|max:255',
                'no_sim' => 'string|max:255',
                'no_npwp' => 'string|max:255',
                'no_passport' => 'string|max:255',
                'jenis_kelamin' => 'required|string',
                'agama' => 'required|string',
                'tempat' => 'required|string',
                'alamat' => 'required|string',
                'tanggal_lahir' => 'required|string',
                'status' => 'required|string',
                'no_hp' => 'required|string',
                'tinggi' => 'required|string',
                'berat' => 'required|string',
                'bank' => 'string',
                'no_rekening' => 'string',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $request->image,
            ]);

         
            // if profile not null update
            if ($user->profile) {
                $profile = $user->profile()->update([
                    'no_ktp' => $request->no_ktp,
                    'no_sim' => $request->no_sim,
                    'no_npwp' => $request->no_npwp,
                    'no_passport' => $request->no_passport,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
                    'tempat' => $request->tempat,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'status' => $request->status,
                    'no_hp' => $request->no_hp,
                    'tinggi' => $request->tinggi,
                    'berat' => $request->berat,
                    'bank' => $request->bank,
                    'no_rekening' => $request->no_rekening,
                ]);
            } else {
                
            $profile = $user->profile()->updateOrCreate([
                'no_ktp' => $request->no_ktp,
                'no_sim' => $request->no_sim,
                'no_npwp' => $request->no_npwp,
                'no_passport' => $request->no_passport,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat' => $request->tempat,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status' => $request->status,
                'no_hp' => $request->no_hp,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'bank' => $request->bank,
                'no_rekening' => $request->no_rekening,
            ]);
            }


        } else {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'image' => 'image|mimes:jpeg,png,jpg|max:3072',
            ]);

            

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $request->image,
            ]);
        }

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function password()
    {
        return view('pages/profile/password');
    }

    public function updatePassword(Request $request)
    {
        //get user data
        $user = Auth::user();

        //validate data password
        $request->validate([
            'old_password' => 'required|string|min:5',
            'password' => 'required|string|min:5|confirmed',
        ]);

        //cek kesamaan password
        if (!Hash::check($request->get('old_password'), $user->password)) {
            return redirect()
                ->back()
                ->with('error', 'Your current password does not matches with the password.');
        }

        //cek kesamaan password lama dan baru
        if (strcmp($request->get('old_password'), $request->get('password')) == 0) {
            return redirect()
                ->back()
                ->with('error', 'New Password cannot be same as your current password.');
        }

        //update password in table user
        $user->password = bcrypt($request->get('password'));
        $user->save();

        //redirect back
        Alert::success('Sukses', 'Password berhasil diubah');
        return redirect()->back();
    }
}
