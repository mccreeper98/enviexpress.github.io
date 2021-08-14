<?php

require_once 'console/connection.php';

$response = "";

if(isset($_POST['cpo']) && !empty($_POST['cpo']) && isset($_POST['cpd']) && !empty($_POST['cpd']) && isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['lastn']) && !empty($_POST['lastn']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['contact']) && !empty($_POST['contact'])){

$cpo = $_POST['cpo'];
$cpd = $_POST['cpd'];
$name = $_POST['name'];
$last = $_POST['lastn'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$contact = $_POST['contact'];

if(isset($_POST['reason'])){
    $reason = $_POST['reason'];
}else{
    $reason = '';
}

    $insertContact = mysqli_query($connect, "INSERT INTO contactos (cp, name, lastName, email, phone, reason, contact) VALUES ('$cpo', '$name', '$last', '$email', '$phone', '$reason', $contact)");

    $consultaCp = mysqli_query($connect, "SELECT disponibilidad.idDisponibilidad, paqueterias.imagen, paqueterias.nombre, paqueterias.idPaqueteria FROM disponibilidad INNER JOIN paqueterias ON paqueterias.idPaqueteria = disponibilidad.idPaqueteria WHERE disponibilidad.idZona = '$cpd'");

    $num_disponible = mysqli_num_rows($consultaCp);

    if($num_disponible == 0){
        $response = '<h2>No hay disponibilidad en esa zona</h2>';
    }else{
        $aux = 0;
        while($disponibilidad = mysqli_fetch_array($consultaCp)){
            $aux++;
            $response .= '<a onclick="selectPaq('.$aux.', '.$num_disponible.', '.$disponibilidad["idPaqueteria"].', '.$disponibilidad["idPaqueteria"].')"><div class="paq" id="paq'.$aux.'"><img src="img/paqueterias/'.$disponibilidad['imagen'].'" class="paqueteria"></div></a>';
        }
    }

    echo $response;
}else{
    echo 'error';
}

?>