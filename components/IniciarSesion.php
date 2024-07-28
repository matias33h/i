<?php
      

    $host = "localhost";
    $bd = "practica";
    $usuario = "root";
    $contrasenia = "";
    
    try {
        $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
    


function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = validate($_POST['usuario']);
    $password = validate($_POST['password']);

    if (empty($usuario) || empty($password)) {
        header("Location: ../public/login.html?error=Todos los campos son requeridos");
        exit();
    }

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['clave'])) {
        session_start();
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['nombre_completo'] = $user['nombre_completo'];
        $_SESSION['id'] = $user['id'];
        header("Location: ../public/home.html");
        exit();
    } else {
        header("Location: ../public/login.html?error=Usuario o clave incorrectos");
        exit();
    }
} else {
    header("Location: ../public/login.html");
    exit();
}

