<?php
require_once('./includes/config.php');

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
?>
  <script>
    location.replace("home.php");
  </script>
<?php
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BackOffice-Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CUSTOM STYLE CSS -->
  <link rel="stylesheet" href="./assets/css/style.css">


  <!-- ----for favicon--- -->
  <link rel="icon" type="image/ico" href="./assets/images/logo/azoresmedia.ico">
  <link rel="shortcut icon" type="image/ico" href="./assets/images/logo/azoresmedia.ico">

  <!--========JQuery==============  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <!-- ====SWEET ALERT=== -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>


</head>

<body>

  <main>
    <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <img src="./assets/images/logo/azoresmedia.png" style="width: 185px;" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1">Login Here</h4>
                    </div>
                    <!-- ===========LOGIN FORM========== -->
                    <form action="backend/loginUser.php" id="login-form" autocomplete="off">
                      <div class="form-outline mb-4">
                        <input type="username" id="usernameId" class="form-control" placeholder="Enter username" />
                        <label class="form-label" for="usernameId">Username</label>
                      </div>

                      <div class="form-outline mb-4">
                        <input type="password" id="passwordId" class="form-control" />
                        <label class="form-label" for="passwordId">Password</label>
                      </div>

                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block gradient-custom-2 mb-3" id="login-btn" type="button">Log
                          in</button>
                      </div>
                    </form>

                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">We are more than just a company</h4>
                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                      exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script>
    $(document).ready(function() {

      //===========FOR REGISTER USER====================
      $('#login-btn').on('click', function() {

        var username = $('#usernameId').val();
        var password = $('#passwordId').val();
        // alert(email+'&&'+password)


        if (username != "" && password != "") {

          $.ajax({
            url: "./backend/loginUser.php",
            type: "POST",
            data: {
              username: username,
              user_password: password
            },
            success: function(dataResult) {
              var dataResult = JSON.parse(dataResult);
              if (dataResult.statusCode == 200) {
                $("#login-btn").removeAttr("disabled");
                $('#login-form').find('input[type=text]').val('');
                $('#login-form').find('input[type=password]').val('');

                Swal.fire({
                  icon: 'success',
                  title: 'success',
                  text: dataResult.msg
                });
                window.location = 'home.php'

              } else if (dataResult.statusCode == 201) {
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


      //===========FOR LOGIN USER=================  

    });
  </script>







  <footer>
    <!-- Copyright -->
    <div class="footer fixed-bottom" style="background-color: rgba(0, 0, 0, 0.2); text-align: center">
      © 2019 Copyright:
      <a class="text-dark" href>- AzoresSkills</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>