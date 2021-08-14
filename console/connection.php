<?php 
    $host_name  = "localhost";
    $database   = "cotizador3nv1";
    $user_name  = "root";
    $password   = "";

    $connect = mysqli_connect($host_name, $user_name, $password, $database);
    $quer = mysqli_query($connect,"SET NAMES 'UTF8'");
    if (mysqli_connect_errno())
    {
    echo "Error al conectar con servidor MySQL: " . mysqli_connect_error();
    }
?>