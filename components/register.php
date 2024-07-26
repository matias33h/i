<?php
include('conexion.php');

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['nombre_completo'])) {
    $usuario = validate($_POST['usuario']);
    $password = validate($_POST['password']);
    $nombre_completo = validate($_POST['nombre_completo']);

    if (empty($usuario) || empty($password) || empty($nombre_completo)) {
        echo "Todos los campos son requeridos.";
        exit();
    } else {
        // Crear el hash de la contraseña
        $hashedPassword = md5($password);  // Para producción, considera usar password_hash

        // Preparar la consulta para insertar el usuario
        $sql = "INSERT INTO usuarios (usuario, clave, nombre_completo) VALUES (:usuario, :clave, :nombre_completo)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':clave', $hashedPassword);
        $stmt->bindParam(':nombre_completo', $nombre_completo);

        if ($stmt->execute()) {
            echo "Usuario insertado correctamente.";
        } else {
            echo "Error al insertar el usuario.";
        }
    }
} else {
    echo "Complete todos los campos del formulario.";
}
