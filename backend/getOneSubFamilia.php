<?php
include '../includes/config.php';
$subfamiliaID=$_REQUEST['subfamilia_id'];

        $sql = "SELECT * FROM subfamilia WHERE id_sub_familia='".$subfamiliaID."'";
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
 