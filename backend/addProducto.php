<?php
include '../includes/config.php';
$nome=$_POST['nome'];
$preco=$_POST['preco'];
$quantidade=$_POST['quantidade'];
$subFamiliaID=$_POST['subFamilia'];
$tipo_IvaID=$_POST['tipo_IvaDropDown'];

$img_name='';
    if(isset($_FILES['ProductoImg']))
      {
        $errors=array();
        $pimg_name=$_FILES['ProductoImg']['name'];
        $pimg_size=$_FILES['ProductoImg']['size'];
        $pimg_tmp_name=$_FILES['ProductoImg']['tmp_name'];
        $pimg_type=$_FILES['ProductoImg']['type'];

        $tmp=(explode('.',$pimg_name));
        $pimg_ext = end($tmp);

        $img_name=time(). "-".basename($pimg_name);

        $extension=array("jpeg","jpg","png");

          if(in_array($pimg_ext,$extension)===false)
          {
            $errors[]="This extension file not allowed, Please choose a JPG or PNG file.";
          }
          
          if(empty($errors)==true)
          {
                $upload_dir="../assets/images/productos/";
                    move_uploaded_file($pimg_tmp_name,$upload_dir.$img_name);
                
                $sql = "INSERT INTO `productos`( `nome`,`preco`,`quantidade`,`foto`,`id_tipo_iva`,`id_sub_familia`) 
                  VALUES ('$nome','$preco','$quantidade','$img_name','$tipo_IvaID','$subFamiliaID')";
                  if (mysqli_query($conn, $sql)) {
                    echo json_encode(array("statusCode"=>200));
                  } 
                  else {
                    echo json_encode(array("statusCode"=>201));
                  }
                    mysqli_close($conn);
          }
          else
          {
            foreach($errors as $errorsKey=>$value)
            {
              echo json_encode(array("statusCode"=>201));
              echo $value;
              die();
            } 
          }
          // =========END OF ERROR ELSE======
        
      }// ==============END OF FILE IF




?>