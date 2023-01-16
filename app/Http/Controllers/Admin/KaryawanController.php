<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->except('_token');

         $users = User::where('role', '=', 'user')->latest()->filter($params)->paginate($params['show'] ?? 10);
        return view('pages.admin.karyawan.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'email'          => 'required',
            'password'       => 'required',
        ]);

        $id = rand(1000000000, 9999999999);

        $check = User::where('nidn', $id)->first();

        if ($check) {
            $id = rand(1000000000, 9999999999);
        }

        $user = User::create([
            'nidn'          => $id,
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => 'user',
            'image'          => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
        ]);

        Alert::success('Success', 'Berhasil Menambahkan Data Karyawan!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $user = User::findOrFail($id);

        return view('pages.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::findOrFail($id);

        return view('pages.admin.karyawan.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $user = User::findOrFail($id);

        $request->validate([
            'name'           => 'required',
            'email'          => 'required',
        ]);

        $id = rand(1000000000, 9999999999);

        $check = User::where('nidn', $id)->first();

        if ($check) {
            $id = rand(1000000000, 9999999999);
        }

        if ($request->password) {
            $user->update([
                'nidn'          => $id,
                'name'           => $request->name,
                'email'          => $request->email,
                'password'       => bcrypt($request->password),
                'role'           => 'user',
                'image'          => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
            ]);
        }

        $user->update([
            'nidn'          => $id,
            'name'           => $request->name,
            'email'          => $request->email,
            'role'           => 'user',
            'image'          => 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
        ]);

        Alert::success('Success', 'Berhasil Mengubah Data Karyawan!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

         Alert::success('Success', 'Berhasil Menghapus Data Karyawan!');
        return redirect()->route('admin.users.index');
    }
}
