<?php


   require('config.php');


   $sql = "SELECT * FROM services
         WHERE category_id LIKE '%".$_GET['category_id']."%'"; 


   $result = $con->query($sql);


   $json = [];
   while($row = $result->fetch_assoc()){
        $json[$row['service_id']] = $row['service_name'];
   }


   echo json_encode($json);
?>