<?php
include '../includes/config.php';
$subFamiliaDesc = mysqli_real_escape_string($conn,$_REQUEST['desc_subfamilia']);

$sql = "INSERT INTO `subfamilia`( `desc_sub_familia`) VALUES ('$subFamiliaDesc')";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode"=>200,"msg"=>"SubFamilia added successfully"));

} 
else {
echo json_encode(array("statusCode"=>201,"msg"=>"error in adding SubFamilia."));
}

?>