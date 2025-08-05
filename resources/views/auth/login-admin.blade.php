<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Perpustakaan Poliwangi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    body {
        background-color: #f4f4f4;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        width: 100%;
        max-width: 500px;
        padding: 30px;
        border-radius: 15px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #006eff;
        border: none;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #0056d2;
    }

    .logo {
        width: 80px;
        margin-bottom: 10px;
    }

    .text-muted {
        font-size: 15px;
    }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-body text-center">
            <img src="/img/logo.png" alt="Poliwangi Logo" class="logo">
            <h3 class="fw-bold text-primary">Login Admin</h3>
            <p class="text-muted mb-4">Masukkan email dan password Anda untuk masuk ke sistem admin perpustakaan.</p>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control text-start"
                        placeholder="Masukkan email" required autofocus>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control text-start"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
        </div>
    </div>

</body>

</html>
