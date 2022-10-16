<?php
   // Initialize the session
   include 'config2.php';
   // Check if the user is logged in, if not then redirect him to login page
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
       header("location: index.php");
       exit;
   }
   $full_name = $_SESSION['full_name'];
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/nav.css">
   </head>
   <body>
      <?php include'nav_patient.php'; ?>
      <div
         class="bg-image"
         style="
         background: url('assets/image/BG PHOTO.png');
         height: 600px;
         "
         ></div>
        <div class="container">
         <h2 align="center">Services</h2>
<?php
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
?>
<div class="row">
<?php
include 'config.php';
$result = mysqli_query($con, "SELECT * FROM category");
foreach ($result as $row){
   $image = $row['image'];
   $service_name = $row['category_name'];
   $service_price = $row['descr'];
?>  

        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
            <div class="card h-100">
                  <img src='assets/upload_images/<?php echo $image;?>' class="card-img-top">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $service_name;?></h5>
                    <p class="card-text"><?php echo $service_price;?></p>
                  </div>
               </div>
        </div>

<?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><br><div class="row">';
}
?>
</div>
      </div>
      <br>
      <div class="container-fluid bg-light">
         <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
               <div class="well well-sm">
                  <form class="form-horizontal" action="" method="post">
                     <fieldset>
                        <h2 class="text-center">Contact us</h2>
                        <!-- Name input-->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="name">Name</label>
                           <div class="col-md-12">
                              <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                           </div>
                        </div>
                        <!-- Email input-->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="email">Your E-mail</label>
                           <div class="col-md-12">
                              <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                           </div>
                        </div>
                        <!-- Message body -->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="message">Your message</label>
                           <div class="col-md-12">
                              <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                           </div>
                        </div>
                        <br>
                        <div class="form-group">
                           <div class="col-md-12 text-center">
                              <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                           </div>
                        </div>
                        <br>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="bg-white py-5">
  <div class="container py-5">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
        <h2 class="font-weight-light">About Us</h2>
        <p class="font-italic text-muted mb-4">Healthteeth dentists are specialized in different fields to address all your dental concerns and to make sure that you will be provided with unmatched care and safety. Healthteeth Clinic is a full-service general and cosmetic dentistry clinic, providing patients with expertise, technology and a convenient location. We offer a relaxing environment far from your regular dental practices. Our clinic can give a beautiful smile to our patients and a lifetime of happiness.
Healthteeth dentists are specialized in different fields to address all your dental concerns and to make sure that you will be provided with unmatched care and safety. Healthteeth Clinic is a full-service general and cosmetic dentistry clinic, providing patients with expertise, technology and a convenient location. We offer a relaxing environment far from your regular dental practices. Our clinic can give a beautiful smile to our patients and a lifetime of happiness.
</p><a href="about.php" class="btn btn-dark px-5 rounded-pill shadow-sm">Read More</a>
      </div>
      <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="assets/image/LOGO.png" alt="" class="img-fluid mb-4 mb-lg-0"></div>
    </div>
  </div>
</div>
         </div>
      </div>
   </body>
</html>