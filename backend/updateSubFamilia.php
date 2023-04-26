<?php
include '../includes/config.php';
$SubFamiliaID=$_REQUEST['subfamilia_id'];
$DescSubFamilia=$_REQUEST['submailia_desc'];

$sql = "UPDATE subfamilia SET desc_sub_familia='".$DescSubFamilia."' WHERE id_sub_familia='".$SubFamiliaID."'";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200));
} 
else {
    echo json_encode(array("statusCode"=>201,"msg"=>"error in update subfamilia"));
}

mysqli_close($conn);

?>