<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            background: #fff;
        }
        .login-card .card-header {
            background: #0d6efd;
            color: #fff;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
        .btn-primary {
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="card-header py-3">
        <h4 class="mb-0">Admin Login</h4>
    </div>
    <div class="card-body p-4">

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    value="{{ old('email') }}" 
                    placeholder="Enter your email" 
                    required
                >
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    placeholder="Enter your password" 
                    required
                >
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
              

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
