<?php
include '../includes/config.php';
$sql = "SELECT * FROM subfamilia ORDER BY id_sub_familia ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<option disabled selected>Open this select SubFamilia</option>';
    while ($data = mysqli_fetch_row($result)) {
?>
        <option style="position:absolute; z-index:9999" value="<?= $data[0];?>"><?=$data[1];?></option>

<?php

    }
} else {
    echo '<option disabled ?>No Certificate Found!</option>    ';
}

?>