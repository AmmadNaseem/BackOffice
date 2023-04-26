loadProductos();
//  =======For load Productos
function loadProductos() {
  $.ajax({ //create an ajax request to display.php
    type: "GET",
    url: "backend/getProductos.php",
    dataType: "html", //expect html to be returned                
    success: function (response) {
      $("#ProductosTableBody").html(response);
      //alert(response);
    }

  });
}
// ==============when pop model of add will open==========
$(document).delegate("[data-bs-target='#addProductoModal']", "click", function () {
  $.ajax({ //create an ajax request to display.php
    type: "GET",
    url: "backend/getTipoIvaList.php",
    dataType: "html", //expect html to be returned                
    success: function (response) {
      $("#tipo_IvaDropDownListID").html(response);
      //alert(response);
    }
  });
  $.ajax({ //create an ajax request to display.php
    type: "GET",
    url: "backend/getsubFamiliaList.php",
    dataType: "html", //expect html to be returned                
    success: function (response) {
      $("#subFamiliaDropDownListID").html(response);
      //alert(response);
    }
  });

});


// =============Add Productos==================
$('#addProductoBtn').on('click', function () {
  var nome = $('#nomeId').val();
  var preco = $('#precoId').val();
  var quantidade = $('#quantidadeId').val();
  var subFamilia = $('#subFamiliaDropDownListID').val();
  var tipo_IvaDropDown = $('#tipo_IvaDropDownListID').val();
  var imageClean = $('#ProductoImg').val();

  if (nome != "" && preco != "" && imageClean != "" && quantidade != "" && subFamilia != "" && tipo_IvaDropDown) {
    data = new FormData();

    data.append('nome', nome);
    data.append('preco', preco);
    data.append('quantidade', quantidade);
    data.append('subFamilia', subFamilia);
    data.append('tipo_IvaDropDown', tipo_IvaDropDown);
    data.append('prodImg', imageClean);
    data.append('ProductoImg', $('#ProductoImg')[0].files[0]);


    var imgname = $('input[type=file]').val();
    var size = $('#ProductoImg')[0].files[0].size;
    var ext = imgname.substr((imgname.lastIndexOf('.') + 1));

    if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
      if (size <= 1000000) {
        $.ajax({
          url: "backend/addProducto.php",
          type: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          enctype: 'multipart/form-data',
          success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $("#addCertBtn").removeAttr("disabled");
              $('#editProductoForm').find('input:text').val('');
              $('#addProductoForm').find('input[type=number]').val('');
              $('#addProductoForm').find('input[type=file]').val('');
              $('#addProductoModal').modal('hide');
              Swal.fire({
                icon: 'success',
                title: 'success',
                text: 'Product is successfully added.'
              });
              loadProductos();

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

      } //end size
      else {
        Swal.fire({
          icon: 'info',
          title: 'Info',
          text: 'Sorry File size exceeding from 1 Mb'
        });
      }

    } //end FILETYPE
    else {
      Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Sorry Only you can upload JPEG|JPG|PNG|GIF file type'
      });
    }
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Invalid',
      text: 'Input Fields Cant Be Empty'
    });
  }

});


// -----------FOR DELETE Productos-------------
$(document).delegate(".btn-delete-producto", "click", function () {
  Swal.fire({
    title: 'Are you sure you want to delete this Producto?',
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
      var productoId = $(this).attr('id');
      var imgPath = $(this).attr('imgPath');
      // Ajax config
      $.ajax({
        type: "GET", //we are using GET method to get data from server side
        url: 'backend/deleteProducto.php', // get the route value
        data: {
          prod_id: productoId,
          prod_img: imgPath
        }, //set data
        success: function (dataResult) { //once the request successfully process to the server side it will return result here   
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            Swal.fire('Saved!', 'Producto is deleted', 'success')
            loadProductos();

          } else if (dataResult.statusCode == 201) {
            Swal.fire({
              icon: 'error',
              title: 'Invalid',
              text: 'Opps! Error occurred!'
            });
          }

        }
      });

    } else if (result.isDenied) {
      Swal.fire('Producto is not not deleted', '', 'info')
    }
  })



});

// ================update producto modal============
$(document).delegate("[data-bs-target='#editProductoModal']", "click", function () {
  $.ajax({ //create an ajax request to display.php
    type: "GET",
    url: "backend/getTipoIvaList.php",
    dataType: "html", //expect html to be returned                
    success: function (response) {
      $("#edit_tipo_IvaDropDownListID").html(response);
      //alert(response);
    }
  });
  $.ajax({ //create an ajax request to display.php
    type: "GET",
    url: "backend/getsubFamiliaList.php",
    dataType: "html", //expect html to be returned                
    success: function (response) {
      $("#edit_subFamiliaDropDownListID").html(response);
      //alert(response);
    }
  });

  var prod_id = $(this).attr('id');
  $.ajax({
    type: "GET", //we are using GET method to get data from server side
    url: 'backend/getOneProducto.php', // get the route value
    data: {
      producto_id: prod_id
    }, //set data
    success: function (response) { //once the request successfully process to the server side it will return result here
      var response = JSON.parse(response);
      if (response.statusCode == 200) {
        response = response.data;
        $("#editProductoForm [name=\"edit_nome\"]").val(response.nome);
        $("#editProductoForm [name=\"edit_preco\"]").val(response.preco);
        $("#editProductoForm [name=\"edit_quantidade\"]").val(response.quantidade);
        $("#editProductoForm [name=\"edit_edit_subFamiliaDropDownList\"]").val(response.id_sub_familia);
        $("#editProductoForm [name=\"edit_tipo_IvaDropDownList\"]").val(response.id_tipo_iva);
        $("#editProductoForm [name=\"prevImgName\"]").val(response.foto);
        var prevImg = "./assets/images/productos/" + response.foto;
        document.getElementById("prev_prod_img").src = prevImg;
        document.getElementById("editDbProductoID").value = response.id_producto;

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

$('#updateProductoBtn').on('click', function () {

  var editNome = $("#editProductoForm [name=\"edit_nome\"]").val();
  var editPreco = $("#editProductoForm [name=\"edit_preco\"]").val();
  var editQuantidade = $("#editProductoForm [name=\"edit_quantidade\"]").val();
  var editSubFamiliId = $("#editProductoForm [name=\"edit_edit_subFamiliaDropDownList\"]").val();
  var editTipoivaId = $("#editProductoForm [name=\"edit_tipo_IvaDropDownList\"]").val();
  var editProdID = $("#editDbProductoID").val();
  var imageClean = $('#editProductoForm').find('input[type=file]').val();
  var prevImg = $("#editProductoForm [name=\"prevImgName\"]").val();


  if (editNome != "" && editPreco != '' && editQuantidade != '' && editSubFamiliId && editTipoivaId != '') {
    if (imageClean == '') {
      $.ajax({
        url: "backend/updateProducto.php",
        type: "POST",
        data: {
          edit_nome: editNome,
          edit_preco: editPreco,
          edit_quantidade: editQuantidade,
          edit_subfamilia: editSubFamiliId,
          edit_tipiva: editTipoivaId,
          edit_proImg: imageClean,
          prevImg: prevImg,
          edit_prodID: editProdID,
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            $("#updateProductoBtn").removeAttr("disabled");
            $('#editProductoForm').find('input:text').val('');
            $('#editProductoForm').find('input[type=number]').val('');
            $('#editProductoForm').find('input[type=file]').val('');
            $('#editProductoModal').modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'success',
              text: 'Producto is updated successfully.'
            });
            loadProductos();

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
    }
    else{
      data = new FormData();

      data.append('edit_nome', editNome);
      data.append('edit_preco', editPreco);
      data.append('quantidade', editQuantidade);
      data.append('subFamilia', editSubFamiliId);
      data.append('tipo_IvaDropDown', editTipoivaId);
      data.append('editProdID', editProdID);
      data.append('prodImg', imageClean);
      data.append('prevImg', imageClean);
      data.append('ProductoImg', $('#edit_ProductoImg')[0].files[0]);

   
      var imgname = $('#editProductoForm').find('input[type=file]').val();
      var size = $('#edit_ProductoImg')[0].files[0].size;
      var ext = imgname.substr((imgname.lastIndexOf('.') + 1));
  
      if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'PNG' || ext == 'JPG' || ext == 'JPEG') {
        if (size <= 1000000) {
          $.ajax({
            url: "backend/addProducto.php",
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                $("#updateProductoBtn").removeAttr("disabled");
                $('#editProductoForm').find('input:text').val('');
                $('#editProductoForm').find('input[type=number]').val('');
                $('#editProductoForm').find('input[type=file]').val('');
                $('#editProductoModal').modal('hide');
                Swal.fire({
                  icon: 'success',
                  title: 'success',
                  text: 'Product is updated successfully.'
                });
                loadProductos();
  
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
  
        } //end size
        else {
          Swal.fire({
            icon: 'info',
            title: 'Info',
            text: 'Sorry File size exceeding from 1 Mb'
          });
        }
  
      } //end FILETYPE
      else {
        Swal.fire({
          icon: 'info',
          title: 'Info',
          text: 'Sorry Only you can upload JPEG|JPG|PNG|GIF file type'
        });
      }

    }



  }
  else {
    Swal.fire({
      icon: 'error',
      title: 'Invalid',
      text: 'Input Fields Cant Be Empty'
    });
  }

});



$(document).ready(function () {
  $('#productosTable').DataTable();
});



