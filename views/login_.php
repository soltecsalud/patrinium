<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login AYSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap moderno -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap">

    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            max-width: 420px;
            width: 100%;
        }

      .logo {
    display: block;
    margin: 0 auto 1.5rem auto;
    max-width: 250px;
}
        h3 {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            border-radius: 8px;
            background-color: #0a0a23;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1e1e3a;
        }

        .footer-text {
            font-size: 0.8rem;
            color: #999;
            text-align: center;
            margin-top: 1.5rem;
        }

        .footer-text a {
            color: #0a0a23;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <div class="text-center mb-3">
    <img src="views/imgs/patrimonium.jpg" alt="AYSA Logo" style="max-width: 250px; height: auto;">
</div>
        <h3>Inicia Sesión</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="usuarioLogin" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuarioLogin" name="usuarioLogin" required>
            </div>
            <div class="mb-3">
                <label for="contrasenaLogin" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasenaLogin" name="contrasenaLogin" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
           
        </form>
        <div class="footer-text mt-4">
            Copyright © 2025 <a href="" target="_blank">Tachyon</a><br>
            Versión 2.0
        </div>
    </div>
</div>
 <?php
                        include_once "controller/validar_login.php";
                        ?>
</body>
</html>
