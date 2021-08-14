<?php
require_once 'console/connection.php';

if(isset($_POST['cpd'])){
    $cp = $_POST['cpd'];
    
    $querystatement = "SELECT * FROM colonias WHERE cp = '$cp'";

    $result = mysqli_query($connect, $querystatement);
    $res = '<option value="" disabled selected>Selecciona la colonia</option>';
    while($colonia = mysqli_fetch_array($result)){
        $res.= '<option value="'.$colonia['sucursal'].'">'.$colonia['colonia'].'</option>';
    }

    echo $res;
}

?>