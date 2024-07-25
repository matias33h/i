<?php

    $host = "localhost";
    $User = "root";
    $pass = "";

    $db="inicioDeSesiondb";

    $conexion = mysql_connect($host, $User, $pass, $db);

    if(!$conexion){
        echo "Conexion fallida";
    }