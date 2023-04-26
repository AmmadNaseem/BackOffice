<?php
include('./includes/header.php');
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true || $_SESSION['isAdmin'] != true) {
    header("location: /backoffice/pageNotFound.php?access=404");
    exit;
  }
?>
<main>

<!--  add new TipoIva modal-->
<div class="modal fade" id="addTipoIvaModal" tabindex="-1" aria-labelledby="addTipoIvaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTipoIvaModalLabel">Add New TipoIva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTipoIvaForm" method="post" action="" autocomplete="off">
                    <div class="mb-3">
                        <label for="TipoIva_desc">Description</label>
                        <div class="form-Control">
                            <textarea class="form-control m-0" id="TipoIva_desc" name="TipoIva_desc" style="height: 100px">
                            </textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="addTipoIvaBtn" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--  edit TipoIvamodal-->
<div class="modal fade" id="editTipoIvaModal" tabindex="-1" aria-labelledby="editTipoIvaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTipoIvaModalLabel">Edit TipoIva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTipoIvaForm" method="post" action="" autocomplete="off">
                    <div class="mb-3">
                        <label for="editTipoIva_desc">Description</label>
                        <div class="form-Control">
                            <textarea class="form-control m-0" id="editTipoIva_desc" name="tipoIva_desc" style="height: 100px">
                            </textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="dbTipoIvaID">
                <button type="button" id="updateTipoIvaBtn" class="btn btn-primary">update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <h1 class="my-2">List of Tipo_Iva</h1>
    </div>
    <div class="row my-3">
        <div class="col">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTipoIvaModal">Add New tipo_Iva</button>
        </div>
    </div>

    <div class="table-responsive my-3">
        <table id="tipo_IvaTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tipo_IvaTableBody">
          
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>

            </tfoot>
        </table>

    </div>

</div>

</main>



    <!-- ----custom scripts==== -->
    <script src="./assets/scripts/tipoiva.js"></script>
<?php
include('./includes/footer.php')
?>