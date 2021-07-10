<?php
   require 'config.inc.php';
   session_start(); 
   if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   header('location:/BloodBankProj/Welcome.php');
   exit;
   }
     $name = ''; 
      $email = '';
      $password = '';
      $type = '';
      $blood = ''; 
      if (isset($_POST['submit'])) { // true on form submit
          $ok = true; 
          if (!isset($_POST['name']) || $_POST['name'] === '') {
              $ok = false;
          } else {
              $name = $_POST['name']; 
          }
          if (!isset($_POST['email']) || $_POST['email'] === '') {
              $ok = false;
          } else {
              $email = $_POST['email']; 
          } 
          if (!isset($_POST['password']) || $_POST['password'] === '') {
              $ok = false;
          } else {
              $password = $_POST['password']; 
          }
          if (!isset($_POST['type']) || $_POST['type'] === '') {
              $ok = false;
          } else {
              $type = $_POST['type']; 
          }
          if (!isset($_POST['blood']) || $_POST['blood'] === '') {
              $ok = false;
          }elseif($_POST['type']==="hospital"){
               $blood = "NULL";
          } 
          else {
              $blood = $_POST['blood']; 
          }
          if ($ok) {
            $hash = password_hash($password, PASSWORD_DEFAULT); 
            $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            if ($db->connect_error) {
              die("Connection failed: " . $db->connect_error);
            }
            $sql = sprintf("INSERT INTO registration (name,email,hash,type,blood) 
                            VALUES ('$name','$email','$hash','$type','$blood')");
            $db->query($sql); 
            header('location:/BloodBankProj/Welcome.php');
            $db->close(); 
          }
      }
      ?>
<!DOCTYPE html>
<html>
   <head>
      <title>SignUp</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="disable_list.js"></script>
   </head>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="/BloodBankProj/Index.php">Home</a></li>
               <li><a href="/BloodBankProj/AvailableBloodSample.php">Available Blood Sample</a></li>
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
               <label for="email"><b>Email</b></label>
               <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" required>
            </div>
            <div class = "form-group">
               <label for="password"><b>Password</b></label>
               <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
            </div>
            <div class = "form-group">
               <label for="password-repeat"><b>Repeat Password</b></label>
               <input type="password" class="form-control" placeholder="Repeat Password" name="password-repeat" id="password-repeat" required>
            </div>
            <div class = "form-group">
               <div><label><b>Type</b></label></div>
               <div class="form-check form-check-inline">
                  <input type = "radio" class="form-check-input" name="type" value = "hospital"> 
                  <label class="form-check-label" for="hospital"> Hospital</label>
               </div>
               <div class="form-check form-check-inline">
                  <input type = "radio" class="form-check-input" name="type" value = "receiver"> 
                  <label class="form-check-label" for="receiver"> Receiver</label>
               </div>
            </div>
            <div class = "form-group" >
               <label for="Type"><b>Blood Type</b></label>
               <select name = "blood" class="form-control" >
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
               <button type="submit" name="submit" value="submit">Register</button>
            </div>
         </div>
         <div class = "form-group">
            <label> Already have an account? <a href="/BloodBankProj/SignIn.php ">Sign in</a>.</label>
            <p><a href = "/BloodBankProj/Index.php">Home</a></p>
         </div>
      </form>
   </body>
</html>