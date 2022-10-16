<?php
   // Initialize the session
   include 'config2.php';
   $user_id=$_SESSION['id'];
   $full_name = $_SESSION['full_name'];
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Appointment List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HealTeeth</title>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/nav.css">
   </head>
   <body>
      <?php include'nav_patient.php'; ?>
      <div class="container">
         <br>
         <h1 align="center">List of Booked Appointments</h1>
         <div class="row">
            <div class="col-lg-7 mx-auto">
               <?php
                  if(isset($_GET['status'])){
                      $status = $_GET['status'];
                  }
                  else{
                      $status = '%';
                  }
                  
                  $get_data = "SELECT * FROM `appointments` INNER JOIN category on appointments.category=category.category_id INNER JOIN services ON appointments.service=services.service_id WHERE patient_id = $user_id AND status LIKE '$status';";
                  $run_data = mysqli_query($con,$get_data);
                  $i = 0;
                  while($row = mysqli_fetch_array($run_data))
                  {
                  $sl = ++$i;
                  $id = $row['id'];
                  $name = $row['patient_name'];
                  $adate = date('F j, Y', (strtotime($row['appointment_date'])));
                  $atime = ['appointment_time'];
                  $service = $row['service_name'];
                  $category = $row['category_name'];
                  $status = $row['status'];
                  
                  echo  '<div class="card mt-2 mx-auto p-4 bg-light">
                  <div class="card-body bg-light">
                     <div class="container">
                        <form action="" id="contact-form" role="form" name="contact-form">
                           <div class="controls">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <a href="view-appointment.php?appointment-id='.$row['id'].'">Appointment No. '.$id.'</a>
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
                                       <label for="form_name">Appointment Date: '.$adate.'</label>
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
                           </div>
                        </form>
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