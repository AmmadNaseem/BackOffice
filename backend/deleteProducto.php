<?php
include '../includes/config.php';
$prodID=$_REQUEST['prod_id'];
$prodImg=$_REQUEST['prod_img'];
$prodImgPath="../assets/images/productos/$prodImg";

$sql = "DELETE FROM productos WHERE id_producto='".$prodID."'";

if (mysqli_query($conn, $sql)) {
    unlink($prodImgPath);
    echo json_encode(array("statusCode"=>200));
} 
else {
    echo json_encode(array("statusCode"=>201));
}

mysqli_close($conn);

?>