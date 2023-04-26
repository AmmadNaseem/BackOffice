<?php
include '../includes/config.php';
$tipo_ivaDesc = mysqli_real_escape_string($conn,$_REQUEST['tipo_iva_desc']);

$sql = "INSERT INTO `tipo_iva`( `desc_tipo_iva`) VALUES ('$tipo_ivaDesc')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200,"msg"=>"Tipo_Iva added successfully"));

} 
else {
echo json_encode(array("statusCode"=>201,"msg"=>"error in adding Tipo Iva."));
}

?>