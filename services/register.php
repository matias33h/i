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
    $nombre = validate($_POST['nombre']);
    $apellido = validate($_POST['apellido']);
    $domicilio = validate($_POST['domicilio']);
    $usuario = validate($_POST['usuario']);
    $contraseña = validate($_POST['contraseña']);

    if (empty($nombre) || empty($apellido) || empty($domicilio) || empty($usuario) || empty($contraseña)) {
        header("Location: ../public/register.html?error=Todos los campos son requeridos");
        exit();
    }

    $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, domicilio, usuario, clave) VALUES (:nombre, :apellido, :domicilio, :usuario, :clave)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':domicilio', $domicilio);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':clave', $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../public/register.html?success=Registro exitoso");
        exit();
    } else {
        header("Location: ../public/register.html?error=Error al registrar el usuario");
        exit();
    }
} else {
    header("Location: ../public/register.html");
    exit();
}
