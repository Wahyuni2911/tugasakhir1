<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RFID - Perpustakaan Poliwangi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #004085, #007bff);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        width: 420px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        background: #ffffff;
        padding: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 50px;
        font-weight: bold;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .form-control {
        text-align: center;
        border-radius: 50px;
        border: 2px solid #007bff;
    }

    .logo {
        width: 80px;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>

    <div class="card text-center">
        <div class="card-body">
            <img src="/img/logo.png" alt="Poliwangi Logo" class="logo">
            <h3 class="fw-bold text-primary">Perpustakaan Poliwangi</h3>
            <p class="text-muted">Silakan scan kartu RFID atau masukkan nomor RFID secara manual</p>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('login-rfid') }}" method="POST" id="rfidForm">
                @csrf
                <div class="mb-3">
                    <label for="rfid_code" class="form-label">Scan Kartu RFID</label>
                    <input type="text" class="form-control text-center" name="rfid_code" id="rfid_code" required
                        autofocus>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-id-card"></i> Login
                </button>
            </form>
        </div>
    </div>

</body>

<script>
document.getElementById("rfid_code").focus();

document.getElementById("rfid_code").addEventListener("input", function() {
    if (this.value.length >= 8) { // Jika RFID biasanya 8 karakter
        document.getElementById("rfidForm").submit();
    }
});
</script>

</html>