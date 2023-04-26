<?php
include '../includes/config.php';

$sql = "SELECT * FROM subfamilia";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $i = 1;
    while ($data = mysqli_fetch_row($result)) {
?>
        <tr>
        <td><?= $i++; ?></td>
            <td class="text-capitalize p-4"><?= $data[1];?></td>
            <td>
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editSubFamiliaModal" id="<?= $data[0]; ?>">Edit</button>
                <button class="btn btn-outline-danger  btn-delete-subfamilia" type="button" id="<?= $data[0]; ?>">Delete</button>
            </td>
        </tr>

<?php
    }
} else {
    echo '<div class="mt-3 alert alert-info" role="alert">
              No Record Found!
           </div>';
}
$resultArray = mysqli_fetch_row($result);

// echo json_encode($resultArray);

?>