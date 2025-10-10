<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
			'username' => 'required|string|unique:users,username',
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed|string|min:6|',
			'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

		], [
        // custom message
        'photo.image' => 'File harus berupa gambar.',
        'photo.mimes' => 'Gambar harus berformat jpg, jpeg, png.',
        'photo.max'   => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
		'username.required' => 'Username harus diisi.',
		'name.required' => 'Nama harus diisi.',
		'email.required' => 'Email harus diisi.',
		'email.email' => 'Email tidak valid.',
		'email.unique' => 'Email sudah terdaftar.',
		'password.min' => 'Password minimal 6 karakter.',
		'username.unique' => 'Username sudah terdaftar.',
		'role.required' => 'Role harus diisi.',
		'password.confirmed' => 'Password tidak sesuai.',
		'password.required' => 'Password harus diisi.',
		'password.min' => 'Password minimal 6 karakter.',
    ]);

		if ($request->hasFile('photo')) {
			$photoName = time().'.'.$request->photo->extension();
			$request->photo->move(public_path('photos'), $photoName);
		} else {
			$photoName = null;
		}

        $user = User::create([
            'username' => $validated['username'],
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
			'photo' => $photoName,
            'role' => 2,
        ]);

        return redirect()
	        ->route('login')
	        ->with('success', 'Registrasi Berhasil!');
    }
}
