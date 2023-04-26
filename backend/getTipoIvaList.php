<?php
include '../includes/config.php';
$sql = "SELECT * FROM tipo_iva ORDER BY id_tipo_iva ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<option disabled selected>Open this select tipo_iva</option>';
    while ($data = mysqli_fetch_row($result)) {
?>
        <option value="<?php echo $data[0] ?>"><?php echo $data[1] ?></option>

<?php

    }
} else {
    echo '<option disabled ?>No Certificate Found!</option>    ';
}

?>