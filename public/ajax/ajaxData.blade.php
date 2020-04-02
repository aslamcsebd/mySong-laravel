<?php

   $dbHost = '127.0.0.1';
   $dbUsername = 'root';
   $dbPassword = '';
   $dbName = 'mysong';

   //Connect and select the database
   $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


   if(isset($_POST["songTypeId"])){
       //Get all state data
      $songTypeId = $_POST["songTypeId"];

       $query = $db->query("SELECT * FROM singer_lists WHERE songTypeId = '$songTypeId' ORDER BY songTypeId ASC");
       
       //Count total number of rows
       echo $rowCount = $query->num_rows;
       
       //Display states list
       if($rowCount > 0){
           echo '<option value="">Select Now</option>';
           while($row = $query->fetch_assoc()){ 
               echo '<option value="'.$row['id'].'">'.$row['singerName'].'</option>';
           }
       }else{
           echo '<option value="">No singer</option>';
       }
   }

?>