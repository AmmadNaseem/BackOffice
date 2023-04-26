loadTipoIva();

function loadTipoIva() {
    $.ajax({ //create an ajax request to display.php
        type: "GET",
        url: "backend/getTipoIva.php",
        dataType: "html", //expect html to be returned                
        success: function (response) {
            $("#tipo_IvaTableBody").html(response);
            //alert(response);
        }

    });
}

$(document).delegate("[data-bs-target='#editTipoIvaModal']", "click", function () {
    var TipoIva_Id = $(this).attr('id');
    $.ajax({
        type: "GET", //we are using GET method to get data from server side
        url: 'backend/getOneTipoIva.php', // get the route value
        data: {
            tipo_iva_id: TipoIva_Id
        }, //set data
        success: function (response) { //once the request successfully process to the server side it will return result here
            var response = JSON.parse(response);
            if (response.statusCode == 200) {

                response = response.data;
                document.getElementById('editTipoIva_desc').value = response.desc_tipo_iva;
                document.getElementById('dbTipoIvaID').value = response.id_tipo_iva;

            } else if (dataResult.statusCode == 201) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid',
                    text: 'Opps! Error occurred!'
                });
            }
        }

    });
});




$(document).ready(function () {


    // =------------FOR ADD CERTIFICATE TEMPLATE -----------
    $('#addTipoIvaBtn').on('click', function () {
        var TipoIvaDesc = $('#TipoIva_desc').val();
        if ($.trim(TipoIvaDesc) != "") {
            $.ajax({
                url: "backend/addTipoIva.php",
                type: "POST",
                data: {
                    tipo_iva_desc: TipoIvaDesc,
                },
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $("#addTipoIvaBtn").removeAttr("disabled");
                        $('#addTipoIvaForm').find('textarea').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: dataResult.msg
                        });
                        loadTipoIva();
                        $('#addTipoIvaModal').modal('hide');


                    } else if (dataResult.statusCode == 201) {
                        $("#addTipoIvaBtn").removeAttr("disabled");
                        $("#error").show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid',
                            text: dataResult.msg
                        });
                    }

                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Invalid',
                text: 'Input Fields Cant Be Empty'
            });
        }

    });


    // -----------FOR DELETE CERTIFICATE-------------
    $(document).delegate(".btn-delete-tipoiva", "click", function () {
        Swal.fire({
            title: 'Are you sure you want to delete this TipoIva?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var TipoIvaID = $(this).attr('id');
                // Ajax config
                $.ajax({
                    type: "GET", //we are using GET method to get data from server side
                    url: 'backend/deleteTipoIva.php', // get the route value
                    data: {
                        tipo_iva_id: TipoIvaID
                    }, //set data
                    success: function (dataResult) {
                        if (dataResult == '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid',
                                text: 'Opps! You can not delete this because of constraints!'
                            });

                        }
                        else {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire('Saved!', dataResult.msg, 'success')
                                loadTipoIva();
                            } else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid',
                                    text: 'Opps! Error occurred!'
                                });
                            }
                        }



                    }
                });

            } else if (result.isDenied) {
                Swal.fire('TipoIva is not not deleted', '', 'info')
            }
        })



    });

    // =------------FOR UPDATE CERTIFICATE TEMPLATE -----------
    $('#updateTipoIvaBtn').on('click', function () {
        var tipo_iva_id = $('#dbTipoIvaID').val();
        var EditTipoIvaDesc = $('#editTipoIva_desc').val();

        if ($.trim(EditTipoIvaDesc) != "") {
            $.ajax({
                url: "backend/updateTipoIva.php",
                type: "POST",
                data: {
                    tipo_iva_id: tipo_iva_id,
                    edit_tipoiva_desc: EditTipoIvaDesc,
                },
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
    
                        Swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: 'TipoIva is updated successfully.'
                        });
                        loadTipoIva();
                        $('#editTipoIvaModal').modal('hide');
    
    
                    } else if (dataResult.statusCode == 201) {
                        $("#error").show();
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid',
                            text: 'Opps! Error occurred!'
                        });
                    }
    
                }
            });
    

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Invalid',
                text: 'Input Fields Cant Be Empty'
            });
        }


       

    });




    $('#tipo_IvaTable').DataTable();

});