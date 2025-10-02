<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$users = User::latest()->paginate(5);

        return view('user.index',[
			'users' => $users
		]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return view('user.create');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

		//validasi
		$validated = $request->validate([
			'username' => 'required|string|unique:users,username',
			'name' => 'required|string |max:255',
			'email' => 'required|email|unique:users,email',
			'password' => 'nullable|string|min:6|',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

		], [
        // custom message
        'photo.image' => 'File harus berupa gambar.',
        'photo.mimes' => 'Gambar harus berformat jpg, jpeg, png.',
        'photo.max'   => 'Ukuran gambar tidak boleh lebih dari 2 MB.',

    ]);
		//upload photo

		$photoName = null;
		if ($request->hasFile('photo')) {
			$photoName = time().'.'.$request->photo->extension();
			$request->photo->move(public_path('photos'), $photoName);
		}
		//store
		$users = User::create([
			'username' => $validated['username'],
			'name' => $validated['name'],
			'email' => $validated['email'],
			'password' => bcrypt($validated['password']),
			'photo' => $photoName,

		]);
		return redirect()->route('users.index')->with('success','Data user berhasil ditambahkan');
		// return redirect()->back()->with('error', 'Data user gagal ditambahkan');
		// dd($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user) //route model binding
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) //route model binding
	{
		// $user = User::findOrFail($id); //pake route model binding

		$validated = $request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email,' . $user->id,
			'password' => 'nullable|string|min:6',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
		], [
        // custom message
        'photo.image' => 'File harus berupa gambar.',
        'photo.mimes' => 'Gambar harus berformat jpg, jpeg, png.',
        'photo.max'   => 'Ukuran gambar tidak boleh lebih dari 2 MB.',

    ]);

		if ($request->hasFile('photo')) {
			$oldImage = public_path('photos/' . $user->photo);
			if($user->photo && file_exists($oldImage)) {
				unlink($oldImage);
			}
			$photoName = time() . '.' . $request->photo->extension();
			$request->photo->move(public_path('photos'), $photoName);
			$user->photo = $photoName;
		}

		$user->name = $validated['name'];
		$user->email = $validated['email'];

		if (!empty($validated['password'])) {
			$user->password = bcrypt($validated['password']);
		}

		$user->save();

		return redirect()->route('users.index')->with('success', 'Data user berhasil diupdate');
	}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
		$oldImage = public_path('photos/' . $user->photo);
		if($user->photo && file_exists($oldImage)) {
			unlink($oldImage);
		}
		// $user = User::find($id);
		$user->delete();
		return redirect()->route('users.index')->with('success','Data user berhasil dihapus');
    }
}
