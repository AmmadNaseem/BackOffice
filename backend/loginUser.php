<?php
include '../includes/config.php';

$username = mysqli_real_escape_string($conn, $_REQUEST['username']);
$password = mysqli_real_escape_string($conn, $_REQUEST['user_password']);
$filter_pass = filter_var($password, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);

if (empty($username) && empty($password)) {
    echo json_encode(array("statusCode" => 201, "msg" => "All fields are required"));
    return;
} else {

    $sql = "SELECT * FROM utilizadores WHERE login='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows <= 0) {
        echo json_encode(array("statusCode" => 201, "msg" => "Sorry this username is not exist , please first register."));
    } else {
        $row = mysqli_fetch_assoc($result);
        $db_pass = $row['password'];

        $pass_verify = $filter_pass==$db_pass;

        if ($pass_verify) {


            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['login'];

            if ($row['nivel_utilizador'] == 1) {
                $_SESSION['isAdmin'] = true;
            } else {
                $_SESSION['isAdmin'] = false;
            }

            echo json_encode(array("statusCode" => 200, "msg" => "You have successfully login."));
        } else {
            echo json_encode(array("statusCode" => 201, "msg" => "Sorry, wrong password."));
        }
    }
}
mysqli_close($conn);
?>