<?php
   session_start();
   include 'config.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   $full_name = $_SESSION['full_name'];
   $id = $_SESSION['id'];
   
   if(isset($_POST['submit'])){
      $patient_name = $_POST['patient_name'];
      $email =$_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $categorypick = $_POST['categorypick'];
      $servicepick = $_POST['servicepick'];
      $appointment_date = $_POST['appointment_date'];
      $appointment_time = $_POST['appointment_time'];

      $sql = mysqli_query($con, "SELECT * FROM services WHERE service_id = $servicepick;");
      while($row = mysqli_fetch_array($sql)){
         $duration = $row['service_duration'];
         $sduration = strtotime($row['service_duration']);
         $dduration = date("h:i A", $sduration);
      }

      $sfinish = strtotime($appointment_time) + (strtotime($duration) - strtotime('00:00:00'));
      $finish = date("H:i", $sfinish);
      $dfinish = date("h:i A", $sfinish);

      $insert_data = "INSERT INTO appointments 
      (patient_id, patient_name, email, phone, address, category, service, appointment_date, appointment_time, time_finish) VALUES 
      ('$id','$patient_name', '$email', '$phone', '$address', '$categorypick', '$servicepick', '$appointment_date', '$appointment_time', '$finish');";
      $run_data = mysqli_query($con,$insert_data);

      if($run_data){
         echo "<script type='text/javascript'>";
         echo "alert('Thank you for booking an appointment with Healteeth, please wait for the approval of your appointment');";
         echo "window.location.href = 'appointment-book.php';";
         echo "</script>";
      }else{
         echo "<script type='text/javascript'>";
         echo "alert('Time Slot is unavailable, please choose another Appointment Time');";
         echo "window.location.href = 'appointment-book.php';";
         echo "</script>";
      }
   
   }
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Book an Appointment</title>
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
      <h1 align="center">Book an Appointment</h1>
      <div class="row ">
         <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
               <div class="card-body bg-light">
                  <div class = "container">
                     <form method="POST" enctype="multipart/form-data">
                        <div class="controls">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="form_name">Name *</label>
                                    <input id="form_name" type="text" name="patient_name" class="form-control" placeholder="Please enter your Name *" required="required" data-error="Firstname is required.">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="form_name">Phone *</label>
                                    <input id="form_name" type="text" name="phone" class="form-control" placeholder="Please enter Contact Number *" required="required" data-error="Firstname is required.">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label for="form_name">Address *</label>
                                    <input id="form_name" type="text" name="address" class="form-control" placeholder="Please enter your Address *" required="required" data-error="Firstname is required.">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="title">Select category:</label>
                                    <select name="categorypick" class="form-control">
                                       <option value="">--- Select category ---</option>
                                       <?php
                                          $sql = "SELECT * FROM category"; 
                                          $result = $con->query($sql);
                                          while($row = $result->fetch_assoc()){
                                              echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
                                          }
                                          ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="title">Select service:</label>
                                    <select name="servicepick" class="form-control">
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group mb-4">
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                       <label for="title">Select Date: </label>
                                       <input type="date" name="appointment_date" placeholder="Choose a date" class="form-control" id="reservationDate">
                                       <div class="input-group-append">
                                          <span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- DEnd ate Picker Input -->
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group mb-4">
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                       <label for="title">Select Time: </label>
                                          <input type="time" name="appointment_time" class="form-control">
                                       <div class="input-group-append">
                                          <span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- DEnd ate Picker Input -->
                              </div>
                              <div class="col-md-12"> 
                                 <input type="submit" class="btn btn-success btn-send  pt-2 btn-block " value="Submit" name="submit" >
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- /.8 -->
         </div>
         <!-- /.row-->
      </div>
   </body>
</html>
<!-- ================================================
   Scripts
   ================================================ -->
<!-- jQuery Library -->
<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
<!--angularjs-->
<script type="text/javascript" src="js/plugins/angular.min.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>   
<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>   
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="js/plugins.min.js"></script>
<!--custom-script.js - Add your own theme custom JS-->
<script type="text/javascript" src="js/custom-script.js"></script>
<script>
   $( "select[name='categorypick']" ).change(function () {
       var categoryID = $(this).val();
   
   
       if(categoryID) {
   
   
           $.ajax({
               url: "ajaxData.php",
               dataType: 'Json',
               data: {'category_id':categoryID},
               success: function(data) {
                   $('select[name="servicepick"]').empty();
                   $.each(data, function(key, value) {
                       $('select[name="servicepick"]').append('<option value="'+ key +'">'+ value +'</option>');
                   });
               }
           });
       }else{
           $('select[name="service"]').empty();
       }
   });
</script>