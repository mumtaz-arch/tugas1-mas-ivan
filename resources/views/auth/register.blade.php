
    {{-- <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Username -->
    <div>
        <label for="username">Username</label>
        <input id="username" type="text" name="username" required autofocus>
    </div>


    <!-- Name -->
    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" required>
    </div>

    <!-- Email -->
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>
    </div>

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Register</button>
</form> --}}

<!-- Contoh di login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 20px 0;
    }
    .auth-card {
      max-width: 450px;
      margin: 20px auto;
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      border: none;
    }
    .form-label {
      font-weight: 600;
      color: #495057;
    }
    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
    }
    .auth-logo {
      text-align: center;
      margin-bottom: 25px;
    }
    .auth-logo h2 {
      color: #0d6efd;
      font-weight: 700;
    }
  </style>
</head>
<body>



  <div class="auth-card">
    <div class="auth-logo">
      <h2>BlogApp</h2>
      <p class="text-muted">Create your account</p>
    </div>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input id="username" type="text" name="username" class="form-control" required autofocus>
      </div>
	  <div class="mb-3">
		<label class="form-label">Name</label>
		<input id="name" type="text" name="name" class="form-control" required>
	  </div>
	  <div class="mb-3">
		<label class="form-label">Foto Profil</label>
		<input id="photo" type="file" name="photo" class="form-control">
		<small class="form-text text-muted">Format: jpg, jpeg, png | Max: 2MB</small>
	  </div>

	  <div class="mb-3">
		<label class="form-label">Email</label>
		<input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
		@error('email')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
		<small class="form-text text-muted">Minimal 6 karakter</small>
		@error('password')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
      </div>
	  <div class="mb-3">
		<label class="form-label">Confirm Password</label>
		<input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
		<small class="form-text text-muted">Harus sesuai dengan password diatas</small>
		@error('password_confirmation')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	  </div>

	 <div class="mb-3 form-check">
		<input type="checkbox" class="form-check-input" id="remember" name="remember">
		<label class="form-check-label" for="remember">Remember Me</label>
	  </div>


      <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
	
    <p class="text-center mt-3">Sudah Punya Akun ? <a href="{{ route('login') }}">Login</a></p>
  </div>
</body>
</html>


