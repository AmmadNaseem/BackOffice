<?php
include '../includes/config.php';

$tipo_ivaID=$_REQUEST['tipo_iva_id'];

$sql = "DELETE FROM tipo_iva WHERE id_tipo_iva='".$tipo_ivaID."'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200,"msg"=>"TipoIva is Deleted successfully."));
} 
else {
    echo json_encode(array("statusCode"=>201));
}

    mysqli_close($conn);
?>