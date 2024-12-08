<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Service Solution Project</title>
    <!-- Link ke CSS menggunakan helper asset -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Link Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
    background-color: #f0f0f0; /* Background warna abu-abu */
    background-image: url('images/background.jpg'); /* Gambar sebagai background */
    background-size: cover; /* Menutupi seluruh area */
    background-position: center; /* Menempatkan gambar di tengah */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.container-fluid {
    min-height: 100vh; /* Menggunakan seluruh tinggi layar */
}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <!-- Pastikan logo sudah ada di public/images/logo.jpg -->
                <img src="{{ asset('images/logo.jpg') }}" alt="Service Solution Project Logo">
            </div>
            <h2>Welcome to Service Solution Project</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="username" required placeholder="Username">
                    <i class="fas fa-user icon"></i> <!-- Ikon user -->
                </div>
                <div class="input-group">
                    <input type="password" name="password" required placeholder="Password">
                    <i class="fas fa-lock icon"></i> <!-- Ikon kunci/password -->
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox" name="remember">
                        Remember Me
                    </label>
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
                <button type="submit">Login</button>
            </form>
            <footer>
                <p>© 2024 Service Solution Project</p>
            </footer>
        </div>
    </div>
</body>
</html>
