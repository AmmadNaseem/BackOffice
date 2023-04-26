<?php
include '../includes/config.php';
$TipoIvaID=$_REQUEST['tipo_iva_id'];

        $sql = "SELECT * FROM tipo_iva WHERE id_tipo_iva='".$TipoIvaID."'";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            $row = $result->fetch_assoc();
            echo json_encode(array("statusCode"=>200,"data"=>$row));
        }
        else {
            echo json_encode(array("statusCode"=>201,"data"=>'No Record exist'));
            }

 

    mysqli_close($conn);
	
?>
 