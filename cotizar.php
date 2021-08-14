<?php
if(isset($_POST['paq']) && isset($_POST['peso'])){

    require_once('console/connection.php');
    
    $id = $_POST['paq'];
    $peso = $_POST['peso'];

    $res = '';

    if($id != 5){
        $queryStatement = "SELECT * FROM tarifas WHERE idPaqueteria = $id AND de <= $peso AND hasta >= $peso";

        $result = mysqli_query($connect, $queryStatement);

        while($tarifa = mysqli_fetch_array($result)){
            $res = $tarifa['precio'];
        }
    }

    echo $res;
}
?>