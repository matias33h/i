<?php

    include('../config/conexion.php');
    
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $usuario = validate($_POST['usuario']);
        $password = validate($_POST['password']);
    
        if (empty($usuario)) {
            header("Location: index.php?error=El usuario es requerido");
            exit();
        } elseif (empty($password)) {
            header("Location: index.php?error=La clave es requerida");
            exit();
        } else {
            // Crear el hash de la contraseña
            $clave = md5($password);
    
            // Preparar la consulta para verificar el usuario
            $sql = "SELECT * FROM usuarios WHERE usuario=:usuario AND clave=:clave";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':clave', $clave);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Verificar si el usuario existe
            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                session_start();
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['nombre'] = $user['nombre_completo'];
                $_SESSION['id'] = $user['id'];
                header("Location: register.php");
                exit();
            } else {
                header("Location: index.php?error=Usuario o clave incorrectos");
                exit();
            }
        }
    }
        