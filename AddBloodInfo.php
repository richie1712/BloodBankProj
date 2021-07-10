<?php
   require 'config.inc.php';
   session_start(); 
   if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
      header('location:/BloodBankProj/Welcome.php');
      exit;
   }
   if($_SESSION["type"] !== "hospital"){
      header('location:/BloodBankProj/Welcome.php');
   }
      $name = ''; 
      $blood = ''; 
      // placeholders are filled by value below
      if (isset($_POST['submit'])) { // true on form submit
          $ok = true; 
          if (!isset($_POST['name']) || $_POST['name'] === '') {
              $ok = false;
          } else {
              $name = $_POST['name']; 
          }
          if (!isset($_POST['blood']) || $_POST['blood'] === '') {
              $ok = false;
          } else {
              $blood = $_POST['blood']; 
          }
         if ($ok) {
            $hash = password_hash($password, PASSWORD_DEFAULT); 
            $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($db->connect_error) {
              die("Connection failed: " . $db->connect_error);
            }
            $sql = sprintf("INSERT INTO bloodavailable (name,blood) 
                            VALUES ('$name','$blood')");
            $db->query($sql); 
            echo '<p>Blood Info Added</p>';
            $db->close(); 
          }
      }
      ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Add Blood Info</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
               <li><a href="/BloodBankProj/Welcome.php">Blood Bank</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="/BloodBankProj/AvailableBloodSample.php">Available Blood Sample</a></li>
               <li><a href="/BloodBankProj/ViewRequest.php">View Request</a></li>
               <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            </ul>
         </div>
      </nav>
      <form method= "POST" action="">
         <div>
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <div class = "form-group">
               <label for="name"><b>Name</b></label>
               <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" required>
            </div>
            <div class = "form-group">
               <label for="Type"><b>Blood Type</b></label>
               <select name = "blood" class="form-control">
               <option value = ""> Please Select </option>
               <option value = "O+"<?php if($blood === 'O+'){ echo ' selected'; }?>> O+ </option>
               <option value = "O-"<?php if($blood === 'O-'){ echo ' selected'; }?>> O- </option>
               <option value = "A+"<?php if($blood === 'A+'){ echo ' selected'; }?>> A+ </option>
               <option value = "A-"<?php if($blood === 'A-'){ echo ' selected'; }?>> A- </option>
               <option value = "B+"<?php if($blood === 'B+'){ echo ' selected'; }?>> B+ </option>
               <option value = "B-"<?php if($blood === 'B-'){ echo ' selected'; }?>> B- </option>
               <option value = "AB+"<?php if($blood === 'AB+'){ echo ' selected'; }?>> AB+ </option>
               <option value = "AB-"<?php if($blood === 'AB-'){ echo ' selected'; }?>> AB- </option>
               <select>
            </div>
            <div class = "form-group">
               <button type="submit" name="submit" value="submit">Add Info</button>
            </div>
         </div>
      </form>
   </body>
</html>