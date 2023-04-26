<?php
include('./includes/header.php');
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true || $_SESSION['isAdmin'] != true) {
    header("location: /backoffice/pageNotFound.php?access=404");
    exit;
  }
?>
<style>

  th:nth-child(2) {
    width: 70%;
  }
  /* td:nth-child(2) {
    width: 70%;
    overflow-y: scroll;
    height: 20px;
  } */


</style>
<main>

    <!--  add new familia modal-->
    <div class="modal fade" id="addFamiliaModal" tabindex="-1" aria-labelledby="addFamiliaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFamiliaModalLabel">Add New Sub Familia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSubFamiliaForm" method="post" action="" autocomplete="off">
                        <div class="mb-3">
                            <label for="subfamilia_desc">Description</label>
                            <div class="form-Control">
                                <textarea class="form-control m-0" id="subfamilia_desc" name="subfamilia_desc" style="height: 100px">
                                </textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="addSubFamiliaBtn" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--  edit Familiamodal-->
    <div class="modal fade" id="editSubFamiliaModal" tabindex="-1" aria-labelledby="editSubFamiliaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubFamiliaModalLabel">Edit Sub Familia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSubFamiliaForm" method="post" action="" autocomplete="off">
                        <div class="mb-3">
                            <label for="subfamilia_desc">Description</label>
                            <div class="form-Control">
                                <textarea class="form-control m-0" id="editSubfamilia_desc" name="subfamilia_desc" style="height: 100px">
                                </textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="dbSubFamiliaID">
                    <button type="button" id="updateSubFamiliaBtn" class="btn btn-primary">update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1 class="my-2">List of Subfamililia</h1>
        </div>
        <div class="row my-3">
            <div class="col">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addFamiliaModal">Add New SubFamilia</button>
            </div>
        </div>

        <div class="table-responsive my-3">
            <table id="subFamiliaTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="subFamiliaTableBody">
              
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
<script src="./assets/scripts/subfamilia.js"></script>
<?php
include('./includes/footer.php')
?>