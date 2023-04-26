<?php
include '../includes/config.php';
$tipo_ivaID=$_REQUEST['tipo_iva_id'];
$Desctipo_iva=$_REQUEST['edit_tipoiva_desc'];

$sql = "UPDATE tipo_iva SET desc_tipo_iva='".$Desctipo_iva."' WHERE id_tipo_iva='".$tipo_ivaID."'";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200));
} 
else {
    echo json_encode(array("statusCode"=>201,"msg"=>"error in update tipo_iva"));
}

mysqli_close($conn);

?>