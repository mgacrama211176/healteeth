<?php
   // Initialize the session
   include 'config2.php';
   $user_id=$_SESSION['id'];
   $full_name = $_SESSION['full_name'];
   $appoint_id = $_GET['appointment-id'];
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Booked Appointment</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HealTeeth</title>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <style type="text/css">
         @media (min-width: 768px) {
         .navbar-brand.abs
         {
         position: absolute;
         width: auto;
         left: 50%;
         transform: translateX(-50%);
         text-align: center;
         }
         }
         .custom {
         display: inline-block;
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: -70px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom1 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: -35px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom2 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 0px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom3 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 35px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom4 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 70px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom5 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 135px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom6 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 300px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom7 {
         width: 120px;
         height: 50px;
         background: url("../images/v16_28.png");
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         opacity: 1;
         position: relative;
         left: 350px;
         box-shadow: 6px 3px 4px rgba(0, 0, 0, 1);
         overflow: hidden;
         }
         .custom:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom1:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom2:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom3:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom4:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom5:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom6:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         .custom7:active {
         background-color: #445c6d;
         box-shadow: 0 5px #666;
         transform: translateY(4px);
         }
         body {
         font-family: 'Lato', sans-serif;
         }
         h1 {
         margin-bottom: 40px;
         }
         label {
         color: #333;
         }
         .btn-send {
         font-weight: 300;
         text-transform: uppercase;
         letter-spacing: 0.2em;
         width: 80%;
         margin-left: 3px;
         }
         .help-block.with-errors {
         color: #ff5050;
         margin-top: 5px;
         }
         .card{
         margin-left: 10px;
         margin-right: 10px;
         }
      </style>
   </head>
   <body>
      <nav class="navbar navbar-white bg-white flex-nowrap">
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a class="navbar-brand" href="#"><img src="assets/image/Facebook.png" alt="Facebook" width="40" height="40"></a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="navbar-brand" href="#"><img src="assets/image/Twitter.png" alt="Twitter" width="40" height="40"></a> &nbsp;&nbsp;&nbsp;&nbsp; <a class="navbar-brand" href="#"><img src="assets/image/Telegram.png" alt="Telegram" width="40" height="40"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <div class="container-fluid nav justify-content-center">
            <ul class="nav">
               <li class="nav-item"><img src="assets/image/Location.png" alt="Location" width="60" height="60"></li>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <li class="nav-item"><img src="assets/image/Time.png" alt="Time" width="60" height="60"></li>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <li class="nav-item"><img src="assets/image/Email.png" alt="Email" width="60" height="60"></li>
            </ul>
         </div>
         <div class="w-100">
            <!--spacer-->
         </div>
      </nav>
      <nav class="navbar navbar-expand-md sticky-top navbar-light bg-light">
         <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="navbar-brand" href="#"><img src="assets/image/LOGO.png" alt="LOGO" width="320" height="150"></a>
               </li>
            </ul>
         </div>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <div class="mx-auto order-0">
            <div class="mx-auto order-0">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item"><button class="custom" onclick="window.location='welcome.php';">Home</button></li>
                  <li class="nav-item"><button class="custom1" onclick="window.location='appointment-book.php';">Book an Appointment</button></li>
                  <li class="nav-item"><button class="custom2" onclick="window.location='appointment-list.php';">See List of Appointments</button></li>
                  <li class="nav-item"><button class="custom3">Contact Us</button></li>
                  <li class="nav-item"><button class="custom4">About</button></li>
                  <li class="nav-item"><button class="custom5" onclick="window.location='user-profile.php';">User Profile</button></li>
                  <li class="nav-item"><button class="custom6">Welcome <?php echo $full_name;?></button></li>
                  <li class="nav-item"><button class="custom7" onclick="window.location='logout.php';">Sign Out</button></li>
               </ul>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2"></div>
         </div>
      </nav>
      <div class="container">
         <br>
         <h1 align="center">Booked Appointment Details</h1>
         <div class="row">
            <div class="col-lg-7 mx-auto">
               <?php
                  if(isset($_GET['status'])){
                      $status = $_GET['status'];
                  }
                  else{
                      $status = '%';
                  }
                  
                  $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE patient_id = $user_id AND id = $appoint_id;";
                  $run_data = mysqli_query($con,$get_data);
                  while($row = mysqli_fetch_array($run_data))
                  {
                  $id = $row['id'];
                  $name = $row['patient_name'];
                  $email = $row['email'];
                  $contact = $row['phone'];
                  $address = $row['address'];
                  $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                  $atime = $row['appointment_time'];
                  $service = $row['service_name'];
                  $category = $row['category_name'];
                  $price = $row['service_price'];
                  $status=$row['status'];
                  
                  echo  '<div class="card mt-2 mx-auto p-4 bg-light">
                  <div class="card-body bg-light">
                     <div class="container">
                           <div class="controls">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <a href="">Appointment Number: '.$id.'</a>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Name: '.$name.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Email Address: '.$email.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Contact Number: '.$contact.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Address: '.$address.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Appointment Date: '.$adate.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Appointment Time: '.date("h:i A", strtotime($atime)).'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Service: '.$service.'</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Price: '.$price.' Pesos</label>
                                    </div>
                                 </div>
                              </div>';
                  echo                 '<div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Status: '.$status.'</label>
                                    </div>
                                 </div>
                              </div>
                              <form action="appointment-list.php" method="POST">
                              <input type="submit" class="btn btn-success btn-send  pt-2 btn-block " value="Return to Appointment List">
                              </form>
                           </div>
                     </div>
                  </div>
                  </div>';
                  }
                  ?>
            </div>
         </div>
      </div>
   </body>
</html>
<!-- ================================================
   Scripts
   ================================================ -->
<!-- jQuery Library -->
<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script> <!--angularjs-->
<script type="text/javascript" src="js/plugins/angular.min.js"></script> <!--scrollbar-->
<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script> 
<script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script> 
<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script> <!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="js/plugins.min.js"></script> <!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="js/custom-script.js"></script>