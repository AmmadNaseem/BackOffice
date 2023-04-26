<?php
include '../includes/config.php';
$subFamiliaID=$_REQUEST['subfamilia_id'];

    $sql = "DELETE FROM subfamilia WHERE id_sub_familia='".$subFamiliaID."'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo json_encode(array("statusCode"=>201));
    }

    mysqli_close($conn);

?>
