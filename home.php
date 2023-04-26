<?php
include('./includes/header.php')
?>
<main>

    <!--  add new productos modal-->
    <div class="modal fade" id="addProductoModal" tabindex="-1" aria-labelledby="addProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductoModalLabel">Add New Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductoForm" method="post"  enctype="multipart/form-data" autocomplete="off">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nomeLabel">Nome</span>
                            <input type="text" id="nomeId" min="0" required name="nome" class="form-control" placeholder="Enter Nome" aria-label="nome" aria-describedby="nomeLabel">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="precoLabel">Preco</span>
                            <input type="number" id="precoId" min="0" name="preco" class="form-control" placeholder="Enter Preco" aria-label="preco" aria-describedby="precoLabel">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="quantidadeLabel">Quantidade</span>
                            <input type="number" id="quantidadeId" min="0" name="quantidade" class="form-control" placeholder="Enter quantidade" aria-label="quantidade" aria-describedby="quantidadeLabel">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="certTempCat">SubFamilia</span>
                        
                            <select class="form-select form-select-sm" id="subFamiliaDropDownListID" aria-label=".form-select-sm example">
                             
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" for="certTempCat">Tipo_Iva</span>
                            <select class="form-select form-select-sm" id="tipo_IvaDropDownListID" aria-label=".form-select-sm example">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addProductoImg" class="col-form-label">Upload Foto:</label>
                            <input type="file" accept="image/*" class="form-control" id="ProductoImg">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" id="addProductoBtn" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

      <!--  add Edit productos modal-->
      <div class="modal fade" id="editProductoModal" tabindex="-1" aria-labelledby="editProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductoModalLabel">Modify Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductoForm" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="nomeLabel">Nome</span>
                            <input type="text" name="edit_nome" id="edit_nomeId" min="0" required  class="form-control" placeholder="Enter Nome" aria-label="nome" aria-describedby="nomeLabel">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="precoLabel">Preco</span>
                            <input type="number" id="edit_precoId" min="0" name="edit_preco" class="form-control" placeholder="Enter Preco" aria-label="preco" aria-describedby="precoLabel">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="quantidadeLabel">Quantidade</span>
                            <input type="number" id="edit_quantidadeId" min="0" name="edit_quantidade" class="form-control" placeholder="Enter quantidade" aria-label="quantidade" aria-describedby="quantidadeLabel">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="certTempCat">SubFamilia</span>
                        
                            <select class="form-select form-select-sm" name="edit_edit_subFamiliaDropDownList" id="edit_subFamiliaDropDownListID" aria-label=".form-select-sm example">
                             
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" for="certTempCat">Tipo_Iva</span>
                            <select class="form-select form-select-sm" name="edit_tipo_IvaDropDownList" id="edit_tipo_IvaDropDownListID" aria-label=".form-select-sm example">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addProductoImg" class="col-form-label">Previous Foto:</label><br>
                            <img src="" id="prev_prod_img" class="img-thumbnail" style="width: 150px;height:150px;" alt="previous foto">
                            <input type="hidden" name="prevImgName">

                        </div>
                        <div class="mb-3">
                            <label for="addProductoImg" class="col-form-label">Upload Foto:</label>
                            <input type="file" accept="image/*" name="edit_ProductoImg" class="form-control" id="edit_ProductoImg">
                        </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editDbProductoID" name="editDbProducto">
                    <button type="button" id="updateProductoBtn" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h1 class="my-2">List of Productos</h1>
        </div>
        <div class="row my-3">
        <?php 
            if($_SESSION['isAdmin'] == true){
                ?>
            <div class="col">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProductoModal">Add New Producto</button>
            </div>
                <?php
            }
            ?>
        </div>

        <div class="table-responsive my-3">
            <table id="productosTable" class="display" style="width:100%">
                <thead>

                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th>Quantidade</th>
                        <th>Subfamilia</th>
                        <th>Tipo_Iva</th>
                        <?php
                        if($_SESSION['isAdmin'] == true){
                            echo '<th>Action</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody id="ProductosTableBody">


                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Preco</th>
                        <th>Quantidade</th>
                        <th>Subfamilia</th>
                        <th>Tipo_Iva</th>
                        <?php
                        if($_SESSION['isAdmin'] == true){
                            echo '<th>Action</th>';
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>

        </div>

    </div>

</main>

<!-- ----custom scripts==== -->
<script src="./assets/scripts/home.js"></script>

<?php
include('./includes/footer.php')
?>