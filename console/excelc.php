<?php
  $letterArr=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','BB','CC','DD','EE','FF','GG','HH','II','JJ','KK','LL','MM','NN','OO','PP','QQ','RR','SS','TT','UU','VV','WW','XX','YY','ZZ'];

    $archivo = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $url = 'archivos/'.$archivo;
    $response = 0;
    if(move_uploaded_file($temp, $url)){

        require_once 'PHPExcel/Classes/PHPExcel.php';
        require_once 'connection.php';

        $archivo = $url;
        $inputFileType = PHPExcel_IOFactory::identify($archivo);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($archivo);
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();


        $num=0;
        for ($row = 2; $row <= $highestRow; $row++){ 
        $num++;
        
            if($sheet->getCell("A".$row)->getValue() != ''){
            
                $insertZona = mysqli_query($connect, "INSERT INTO colonias(cp, sucursal, colonia) VALUES('".$sheet->getCell('A'.$row)->getValue()."', '".$sheet->getCell('B'.$row)->getValue()."', '".$sheet->getCell("F".$row)->getValue()."')");
            
                if($insertZona){
                    $response =  'si';
                }else{
                    $response = 'no zona';
                }
            }else{
                break;
            }

            // if($num > 1){
            //     $response = 1;
            // }
        }

    }

    echo $response;
    exit;
?>