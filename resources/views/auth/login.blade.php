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
      <h2>Post</h2>
      <p class="text-muted">Sign in to your account</p>
    </div>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" required autofocus>
        @error('username')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-3">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
  </div>
</body>
</html>
