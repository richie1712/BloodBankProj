<?php
   require 'config.inc.php';
      session_start(); 
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
         header('location:/BloodBankProj/Welcome.php');
         exit;
      }
      $email = '';
      $password = '';
      if (isset($_POST['submit'])) { // true on form submit
        $ok = true; 
        if (!isset($_POST['email']) || $_POST['email'] === '') {
            $ok = false;
            echo 'Please fill email';
        } else {
            $email = $_POST['email']; 
        } 
        if (!isset($_POST['password']) || $_POST['password'] === '') {
            $ok = false;
            echo 'Please fill password';
        } else {
            $password = $_POST['password']; 
        }
        if ($ok) {
         $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
          if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
          }
          $sql = sprintf("SELECT * from registration where email = '%s'",
          mysqli_real_escape_string($db, $email));
          $result = $db->query($sql);
          $row = $result->fetch_object();
          if($row != null){
             $hash = $row->hash;
             if(password_verify($password, $hash)){
               echo 'Login successful';
               $_SESSION["loggedin"]=true;
               $_SESSION["name"] = $row->name;
               $_SESSION["type"] = $row->type;
               header('location:/BloodBankProj/Welcome.php');
             }
             else {
               echo "User Not Found";
           }
          }
           else {
            echo "User Not Found";
        }
          $db->close(); 
        }
      }
      ?>
<!DOCTYPE html>
<html>
   <head>
      <title>SignIn</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="/BloodBankProj/Index.html">Home</a></li>
               <li><a href="/BloodBankProj/AvailableBloodSample.php">Available Blood Sample</a></li>
            </ul>
         </div>
      </nav>
      <form method = "POST" action="">
         <div>
            <h1>Login</h1>
            <p>Please enter your credentials here</p>
            <div class = "form-group">
               <label for="email"><b>Email</b></label>
               <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" required>
            </div>
            <div class = "form-group">
               <label for="password"><b>Password</b></label>
               <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
            </div>
            <div class = "form-group">
               <button type="submit" name="submit" value = submit>Login</button>
            </div>
         </div>
         <div class = "form-group">
            <p>Don't have an account? <a href="/BloodBankProj/SignUp.php">Sign Up</a>.</p>
         </div>
      </form>
   </body>
</html>
