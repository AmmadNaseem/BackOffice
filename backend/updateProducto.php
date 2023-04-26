<?php
include '../includes/config.php';

	$nome=$_REQUEST['edit_nome'];
	$preco=$_REQUEST['edit_preco'];
	$quantidade=$_REQUEST['edit_quantidade'];
	$subfamilia=$_REQUEST['edit_subfamilia'];
	$tipiva=$_REQUEST['edit_tipiva'];
	$edit_proImg=$_REQUEST['edit_proImg'];
	$prodID=$_REQUEST['edit_prodID'];
	$prevImg=$_REQUEST['prevImg'];


    if (empty($edit_proImg)) {
        $sql = "UPDATE productos SET nome='".$nome."', preco='".$preco."',quantidade ='".$quantidade."', id_tipo_iva ='".$tipiva."', id_sub_familia ='".$subfamilia."' WHERE id_producto ='".$prodID."'";
       if (mysqli_query($conn, $sql)) {
           echo json_encode(array("statusCode"=>200));
       } 
       else {
           echo json_encode(array("statusCode"=>201,"msg"=>"error update product without image"));
       }
    }
    else{
        
        $nome=$_POST['edit_nome'];
        $preco=$_POST['edit_preco'];
        $quantidade=$_POST['quantidade'];
        $subFamiliaID=$_POST['quantidade'];
        $tipo_IvaID=$_POST['tipo_IvaDropDown'];
        $prodID=$_POST['editProdID'];
        $prodImgPath="../assets/images/productos/$prevImg";

        
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
                        
                        $sql = "UPDATE productos SET nome='".$nome."', preco='".$preco."', foto='".$img_name."',quantidade ='".$quantidade."', id_tipo_iva ='".$tipiva."', id_sub_familia ='".$subfamilia."' WHERE id_producto ='".$prodID."'";
                        if (mysqli_query($conn, $sql)) {
                        unlink($prodImgPath);
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
        
        

        

    }
  

	mysqli_close($conn);



?>