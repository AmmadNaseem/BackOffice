loadSubFamilia();

function loadSubFamilia() {
$.ajax({ //create an ajax request to display.php
  type: "GET",
  url: "backend/getSubFamilia.php",
  dataType: "html", //expect html to be returned                
  success: function(response) {
    $("#subFamiliaTableBody").html(response);
    //alert(response);
  }

});
}

$(document).delegate("[data-bs-target='#editSubFamiliaModal']", "click", function() {
    var subfamilia_Id = $(this).attr('id');
    $.ajax({
        type: "GET", //we are using GET method to get data from server side
        url: 'backend/getOneSubFamilia.php', // get the route value
        data: {
            subfamilia_id: subfamilia_Id
        }, //set data
        success: function(response) { //once the request successfully process to the server side it will return result here
            var response = JSON.parse(response);
                if (response.statusCode == 200) {

                    response = response.data;
                    console.log(response);
                    document.getElementById('editSubfamilia_desc').value = response.desc_sub_familia;
                    document.getElementById('dbSubFamiliaID').value = response.id_sub_familia;

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




$(document).ready(function() {


    // =------------FOR ADD CERTIFICATE TEMPLATE -----------
    $('#addSubFamiliaBtn').on('click', function() {
        var subFamiliaDesc = $('#subfamilia_desc').val();
        if ($.trim(subFamiliaDesc) != "") {
            $.ajax({
                url: "backend/addSubFamilia.php",
                type: "POST",
                data: {
                  desc_subfamilia: subFamiliaDesc,
                },
                success: function(dataResult) {
                  var dataResult = JSON.parse(dataResult);
                  if (dataResult.statusCode == 200) {
                    $("#addSubFamiliaBtn").removeAttr("disabled");
                    $('#addSubFamiliaForm').find('textarea').val('');
                    Swal.fire({
                      icon: 'success',
                      title: 'success',
                      text: dataResult.msg
                    });
                    loadSubFamilia();
                    $('#addFamiliaModal').modal('hide');

        
                  } else if (dataResult.statusCode == 201) {
                    $("#addSubFamiliaBtn").removeAttr("disabled");
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
    $(document).delegate(".btn-delete-subfamilia", "click", function() {
        Swal.fire({
            title: 'Are you sure you want to delete this SubFamilia?',
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
                var subFamiliaID = $(this).attr('id');
                // Ajax config
                $.ajax({
                    type: "GET", //we are using GET method to get data from server side
                    url: 'backend/deleteSubFamilia.php', // get the route value
                    data: {
                        subfamilia_id: subFamiliaID
                    }, //set data
                    success: function(dataResult) { 
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
                                loadSubFamilia();
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
                Swal.fire('SubFamilia is not not deleted', '', 'info')
            }
        })



    });

    // =------------FOR UPDATE CERTIFICATE TEMPLATE -----------
    $('#updateSubFamiliaBtn').on('click', function() {
        var subFfamilia_id = $('#dbSubFamiliaID').val();
        var EditSubFamiliaDesc = $('#editSubfamilia_desc').val();
        if ($.trim(EditSubFamiliaDesc) != "") {
            
        $.ajax({
            url: "backend/updateSubFamilia.php",
            type: "POST",
            data: {
                subfamilia_id: subFfamilia_id,
                submailia_desc: EditSubFamiliaDesc,
            },
            success: function(dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {

                    Swal.fire({
                        icon: 'success',
                        title: 'success',
                        text: 'SubFamilia is updated successfully.'
                    });
                    loadSubFamilia();
                    $('#editSubFamiliaModal').modal('hide');


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




    $('#subFamiliaTable').DataTable();

});