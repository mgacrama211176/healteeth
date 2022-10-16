<?php
   // Initialize the session
   
   // Check if the user is already logged in, if yes then redirect him to welcome page
   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
       header("location: welcome.php");
       exit;
   }
    
   // Include config file
   require_once "config2.php";
    
   // Define variables and initialize with empty values
   $email_address = $password = "";
   $email_err = $password_err ="";
    
   // Processing form data when form is submitted
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    
       // Check if email is empty
       if(empty(trim($_POST["email"]))){
           $email_err = "Please enter email.";
       } else{
           $email = trim($_POST["email"]);
       }
       
       // Check if password is empty
       if(empty(trim($_POST["password"]))){
           $password_err = "Please enter your password.";
       } else{
           $password = trim($_POST["password"]);
       }
       
       // Validate credentials
       if(empty($email_err) && empty($password_err)){
           // Prepare a select statement
           $sql = "SELECT id, email_address, password, full_name, role, contact_number, full_address FROM user WHERE email_address = ?";
           
           if($stmt = mysqli_prepare($con, $sql)){
               // Bind variables to the prepared statement as parameters
               mysqli_stmt_bind_param($stmt, "s", $param_email);
               
               // Set parameters
               $param_email = $email;
               
               // Attempt to execute the prepared statement
               if(mysqli_stmt_execute($stmt)){
                   // Store result
                   mysqli_stmt_store_result($stmt);
                   
                   // Check if email exists, if yes then verify password
                   if(mysqli_stmt_num_rows($stmt) == 1){                    
                       // Bind result variables
                       mysqli_stmt_bind_result($stmt, $id, $email_address, $password, $full_name, $role, $contact_number, $full_address);
                       if(mysqli_stmt_fetch($stmt)&& $role=='Patient'){
                           if(md5($password)){
                               // Password is correct, so start a new session
                               session_start();
                               
                               // Store data in session variables
                               $_SESSION["loggedin"] = true;
                               $_SESSION["id"] = $id;
                               $_SESSION["email_address"] = $email_address;
                               $_SESSION["contact_number"] = $contact_number;
                               $_SESSION["full_address"] = $full_address;
                               $_SESSION["full_name"] = $full_name;
                               $_SESSION["role"] = $role;
                               $_SESSION["password"] = $password;
                               // Redirect user to welcome page
                               header("location: welcome.php");
                           } 
   
                       } elseif($role=='Doctor'){
                           if(md5($password)){
                               // Password is correct, so start a new session
                               session_start();
                               // Store data in session variables
                               $_SESSION["loggedin"] = true;
                               $_SESSION["id"] = $id;
                               $_SESSION["email"] = $email;                            
                               $_SESSION["full_name"] = $full_name;
                               $_SESSION["role"] = $role;
                               // Redirect user to welcome page
                               header("location: doctor_index.php");
                           } 
                       }
                       elseif($role=='Staff'){
                           if(md5($password)){
                               // Password is correct, so start a new session
                               session_start();
                               
                               // Store data in session variables
                               $_SESSION["loggedin"] = true;
                               $_SESSION["id"] = $id;
                               $_SESSION["email_address"] = $email_address;                            
                               $_SESSION["full_name"] = $full_name;
                               $_SESSION["role"] = $role;
                               // Redirect user to welcome page
                               header("location: staff_index.php");
                           } 
   
                           else{
                               // Password is not valid, display a generic error message
                               $login_err = "Password is incorrect";
                           }
                       }
                   } else{
                       // email doesn't exist, display a generic error message
                       $login_err = "Email doesn't exist";
                   }
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
                              <div class="text-left">
                                 <h2 class="">Sign in to HealTeeth.</h2>
                                 <p>Please login to your account</p>
                                 <br>
                                 <?php 
                                    if(!empty($login_err)){
                                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                    }        
                                    ?>
                              </div>
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                 <div class="form-outline mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email"  name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email_address; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                 </div>
                                 <div class="form-outline mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                 </div>
                                 <div class="text-center pt-1 mb-5 pb-1">
                                    <a class="text-muted" href="reset.php">Forgot password?</a>
                                    <input type="submit" class="btn btn-primary" value="Login">
                                 </div>
                                 <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2">Don't have an account?</p>
                                    <a href="register.php" class="btn btn-outline-danger">Create New</a>
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