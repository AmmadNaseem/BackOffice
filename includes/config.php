<?php
error_reporting(0);
$serverName="localhost";
$database="back_office";
$username="root";
$password="";

$conn=mysqli_connect($serverName,$username,$password,$database);

if ($conn) {
    // echo "Connection established successfully";
    session_start();
 }
 else 
   {
    // .mysqli_connect_error()
       echo '
       <!-- Begin Page Content -->
       <div class="container">
        <div class="row"><!-- database failue -->
         <div class="col-md-6 mr-auto ml-auto text-center py-5 mt-5">
            <div class="card">
              <div .card-body>
                    <h1 class="card-title bg-warning">Database Connection Failed</h1>
                     <h2 class="card-title">Database Failure</h2>
                    <p class="card-title">Please Check Your Database Connection</p>
                    <a href="smile/index">&larr; Back to Dashboard</a>
              </div>
            </div>
         </div> <!---end of col--->
        </div><!---end of row--->

       </div>
       <!-- /.container-fluid -->
       ';
   }

?>