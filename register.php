<?php
   // Include config file
   require_once "config.php";
    
   // Define variables and initialize with empty values
   $name = $email = $password = $confirm_password = $phonenumber = $address ="";
   $name_err = $email_err = $password_err = $confirm_password_err = "";
   
   // Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    
       // Validate email
       if(empty(trim($_POST["email"]))){
           $email_err = "Please enter a email.";
       } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
           $email_err = "Invalid email format";
       } else{
           // Prepare a select statement
           $sql = "SELECT id FROM user WHERE email_address = ?";
           
           if($stmt = mysqli_prepare($con, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "s", $param_email);
               
               // Set parameters
               $param_email = trim($_POST["email"]);
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   /* store result */
                   mysqli_stmt_store_result($stmt);
                   
                   if(mysqli_stmt_num_rows($stmt) == 1){
                       $email_err = "This email is already taken.";
                   } else{
                       $email = trim($_POST["email"]);
                   }
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
   
               // Close statement
               mysqli_stmt_close($stmt);
           }
       }
       
   
   // Validate password
       if(empty(trim($_POST["name"]))){
           $name_err = "Please enter your name.";     
       } else{
           $name = trim($_POST["name"]);
       }
   
       if(empty(trim($_POST["phonenumber"]))){
           $phonenumber_err = "Please enter your Contact Number.";     
       } else{
           $phonenumber = trim($_POST["phonenumber"]);
       }
   
       if(empty(trim($_POST["address"]))){
           $address_err = "Please enter your addresss.";     
       } else{
           $address = trim($_POST["address"]);
       }
   
       // Validate password
       if(empty(trim($_POST["password"]))){
           $password_err = "Please enter a password.";     
       } elseif(strlen(trim($_POST["password"])) < 6){
           $password_err = "Password must have atleast 6 characters.";
       } else{
           $password = trim($_POST["password"]);
       }
       
       // Validate confirm password
       if(empty(trim($_POST["confirm_password"]))){
           $confirm_password_err = "Please confirm password.";     
       } else{
           $confirm_password = trim($_POST["confirm_password"]);
           if(empty($password_err) && ($password != $confirm_password)){
               $confirm_password_err = "Password did not match.";
           }
       }
       
       // Check input errors before inserting in database
       if(empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($phonenumber_err) && empty($address_err)){
           
           // Prepare an insert statement
           $sql = "INSERT INTO user (full_name, email_address, password, contact_number, full_address) VALUES (?, ?, ?, ?, ?)";
            
           if($stmt = mysqli_prepare($con, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_password, $param_phonenumber, $param_address);
               
               // Set parameters
               $param_name = $name;
               $param_email = $email;
               $param_password = md5($password); // Creates a password hash
               $param_phonenumber = $phonenumber;
               $param_address=$address;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   // Redirect to login page
                   header("location: login.php");
               } else{
                   echo "Oops! Something went wrong. Please try again later.";
               }
   
               // Close statement
               mysqli_stmt_close($stmt);
           }
       }
       
       // Close connection
       mysqli_close($con);
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HealTeeth</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
         left: -5px;
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
         left: 30px;
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
         left: 300px;
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
      </style>
   </head>
   <body>
      <nav class="navbar navbar-white bg-white flex-nowrap">
         &nbsp&nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Facebook.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Twitter.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp
         <a class="navbar-brand" href="#">
         <img src="assets/image/Telegram.png" alt="" width="40" height=40>
         </a>
         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
         <div class="container-fluid nav justify-content-center">
            <ul class="nav">
               <li class="nav-item">
                  <img src="assets/image/Location.png" alt="" width="60" height="60">
               </li>
               &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
               <li class="nav-item">
                  <img src="assets/image/Time.png" alt="" width="60" height="60">
               </li>
               &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
               <li class="nav-item">
                  <img src="assets/image/Email.png" alt="" width="60" height="60">
               </li>
            </ul>
         </div>
         <div class="w-100">
            <!--spacer-->
         </div>
      </nav>
      <section class="h-100 gradient-form" style=" background: url('assets/image/bglogin.png');
         height: 600px;">
         <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-xl-10">
                  <div class="card rounded-3 text-black">
                     <div class="row g-0">
                        <div class="col-lg-6">
                           <div class="card-body p-md-5 mx-md-4">
                              <h4>Sign up to HealTeeth.</h4>
                              <p>Please fill this form to create an account.</p>
                              <br>
                              <form method="post" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                 <div class="form-outline mb-4">
                                    <input type="text" name="name" placeholder="Full Name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                                 </div>
                                 <div class="form-outline mb-4">
                                    <input type="email" name="email" placeholder="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                 </div>
                                 <div class="form-outline mb-4">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                 </div>
                                 <div class="form-outline mb-4">
                                    <input type="number" name="phonenumber" placeholder="Phone Number" class="form-control <?php echo (!empty($phonenumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phonenumber; ?>">
                                    <span class="invalid-feedback"><?php echo $phonenumber_err; ?></span>
                                 </div>
                                 <div class="form-outline mb-4">
                                    <input type="text" name="address" placeholder="Address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">
                                    <span class="invalid-feedback"><?php echo $address_err; ?></span>
                                 </div>
                                 <div class="text-center pt-1 mb-5 pb-1">
                                    <a class="btn btn-outline-primary" href="login.php">Login</a>
                                    <input type="submit" class="btn btn-primary" value="Register">
                                 </div>

                                 <div align="center">
                                     <a href="welcome.php" class="btn btn-dark">Back to Home</a>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2" style=" background: url('assets/image/loginmodal.png');
                           height: 600px;">
                           <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </body>
</html>