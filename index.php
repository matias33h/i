<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="iniciarSesion.php" method="POST">
                <div class="input-group">
                    <label for="username">USER</label>
                    <input type="text" name="usuario" id="username" placeholder="User" required>
                </div>
                <div class="input-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <button type="submit">Iniciar Sesion</button>
                <div class="forgot-password">
                    <a href="#">Olvidaste tu contraseña?</a>
                </div>
            </form>
            <div class="register">
                <span>No tienes cuenta?</span>
                <a href="crearCuenta.php">Registrate</a>
            </div>
        </div>
    </div>
</body>
</html>
