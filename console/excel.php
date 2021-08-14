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
        for ($row = 8; $row <= $highestRow; $row++){ 
        $num++;
        
            if($sheet->getCell("B".$row)->getValue() != ''){
            
                $insertZona = mysqli_query($connect, "INSERT INTO zona(cp, estado, municipio) VALUES('".$sheet->getCell('B'.$row)->getValue()."', '".$sheet->getCell('C'.$row)->getValue()."', '".$sheet->getCell("D".$row)->getValue()."')");
            
                if($insertZona){

                    $rr = 0;
                        for($col = 5; $col <= $highestColumn; $col = $col+5){
                            $rr++;
                            $paqName = $sheet->getCell($letterArr[$col].'4')->getValue();
                            
                            if($paqName != ''){

                                $paqueteria = mysqli_query($connect, "SELECT * FROM paqueterias WHERE nombre = '$paqName'");

                                $paqId = mysqli_fetch_array($paqueteria)['idPaqueteria'];
                                
                                $insertDisp = mysqli_query($connect, "INSERT INTO disponibilidad(idDisponibilidad, idZona, idPaqueteria, terrestre, express, extendida, tipo) VALUES('".$sheet->getCell('B'.$row)->getValue().$paqId."', '".$sheet->getCell('B'.$row)->getValue()."', '$paqId', '".$sheet->getCell($letterArr[$col].$row)->getValue()."', '".$sheet->getCell($letterArr[$col+1].$row)->getValue()."', '".$sheet->getCell($letterArr[$col+2].$row)->getValue()."', '".$sheet->getCell($letterArr[$col+3].$row)->getValue()."')");
                            
                                if($insertDisp){
                                    $response =  'si';
                                }else{
                                    $response =  'no';
                                }
                                
                                
                            }else{
                            break;
                            }
                        }
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