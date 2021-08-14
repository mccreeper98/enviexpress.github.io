<?php 
$ide = $_POST['id']; 

require_once 'connection.php';

$sql="DELETE FROM usuarios WHERE id = '".$ide."'";

$result=mysqli_query($connect,$sql);

if($result){
$message = 1;     
} else {
$message = 2;
}

echo $message;
?>