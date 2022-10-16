<?php
   include 'config2.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   $id = $_SESSION['id'];
   $result = mysqli_query($con, "SELECT * FROM user where id = $id");
   while($row = mysqli_fetch_array($result)){
   $full_name = $row['full_name'];
   $email_address = $row['email_address'];
   $contact_number = $row['contact_number'];
   $full_address = $row['full_address'];
   $password = $row['password'];
}
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>User Profile</title>
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
         <h1 align="center">Edit Profile</h1>
         <div class="row">
            <div class="col-lg-7 mx-auto">
               <div class="card mt-2 mx-auto p-4 bg-light">
                  <div class="card-body bg-light">
                     <div class="container">
                        <form method="post" action ="update-user.php" enctype="multipart/form-data">
                           <div class="controls">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Name *</label> <input id="form_name" type="text" name="patient_name" class="form-control" value="<?php echo $full_name;?>" disabled required="required" data-error="Firstname is required.">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_email">Email *</label> <input id="form_email" type="text" name="email" class="form-control" value="<?php echo $email_address;?>" required="required" data-error="Valid email is required.">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Phone *</label> <input id="form_name" type="text" name="phone" class="form-control" value="<?php echo $contact_number;?>" required="required" data-error="Firstname is required.">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Address *</label> <input id="form_name" type="text" name="address" class="form-control" value="<?php echo $full_address;?>" required="required" data-error="Firstname is required.">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="form_name">Password *</label> <input id="form_name" type="password" name="password" class="form-control" value="" data-error="password is required.">
                                       <input id="form_name" type="hidden" name="idnum" class="form-control" value="<?php echo $id;?>;" data-error="password is required.">
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <input type="submit" class="btn btn-success btn-send pt-2 btn-block" value="Submit" name="action">
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="col-md-12">
                                    <input type="submit" class="btn btn-info btn-send pt-2 btn-block" value="Update Password" name="action">
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- /.row-->
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
                 $('select[name="servicepick"]').append('<option value="'+ key +'">'+ value +'<\/option>');
             });
         }
     });
   
   
   }else{
     $('select[name="service"]').empty();
   }
   });
</script>