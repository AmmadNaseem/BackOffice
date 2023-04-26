<?php
include '../includes/config.php';


// $sql = "SELECT * FROM productos";
$sql="SELECT * FROM productos LEFT JOIN subfamilia ON subfamilia.id_sub_familia = productos.id_sub_familia
LEFT JOIN tipo_iva ON tipo_iva.id_tipo_iva = productos.id_tipo_iva";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $i = 1;
?>


    <?php
    while ($data = mysqli_fetch_row($result)) {
        // print("<pre>".print_r($data)."</pre>");
    ?>

        <tr>
            <td><?= $i++; ?></td>
            <td><img src="./assets/images/productos/<?= $data[4]; ?>" class="img-thumbnail" style="width: 100px;height:100px;" alt="<?= $data[4]; ?>"></td>
            <td class="text-capitalize"><?= $data[1]; ?></td>
            <td class="text-capitalize"><?= $data[2]; ?></td>
            <td class="text-capitalize"><?= $data[3]; ?></td>
            <td class="text-capitalize"><?= $data[8]; ?></td>
            <td class="text-capitalize"><?= $data[11]; ?></td>
            <?php 
            if($_SESSION['isAdmin'] == true){
                ?>
                 <td>
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editProductoModal" id="<?= $data[0]; ?>">Edit</button>
                <button class="btn-delete-producto btn btn-outline-danger" imgPath="<?= $data[4]; ?>" id="<?= $data[0]; ?>" type="button">Delete</button>
            </td>
                <?php
            }
           
            ?>

        </tr>

<?php
    }
} else {
    echo '<div class="mt-3 alert alert-info" role="alert">
          No Record Found!
       </div>';
}
$resultArray = mysqli_fetch_row($result);

?>