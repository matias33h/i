<?php

    include('Conexion.php');

    if (isset($_POST['usuario']) && isset($POST['password'])){
        // En resumen, esta función calidate se utiliza para limpiar y
        //  sanear la entrada del usuario, eliminando espacios en blanco innecesarios, deshaciendo el escapado de caracteres
        //  y convirtiendo caracteres especiales a sus equivalentes en entidades HTML para asegurar que los datos sean seguros
        //  para su uso en tu aplicación.
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $usuario = validate($_POST['usuario']);
        $password = validate($_POST['password']);

        if (empty($usuario)){
            header("Location: index.php?error=El usuario es Requerido");
            exit();
        }elseif empty($password){
            header("Location: Index.php?error=La clave es Requerida");
            exit();
        }else{
            // vamos a crear el hashing d ela contraseña para que se incripte 
            $clave = md5($password);

            


        }

    }