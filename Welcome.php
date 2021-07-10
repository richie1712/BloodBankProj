<!-- TODO: SESSION for customized user input -->
<?php
   require 'config.inc.php';
   session_start(); 
   if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
      header('location:/BloodBankProj/Index.html');
      exit;
   }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Welcome</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="mystyle.css">
   </head>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="/BloodBankProj/AvailableBloodSample.php">Available Blood Sample</a></li>
               <?php
               if ($_SESSION["type"] === "hospital") {
                echo '<li><a href="/BloodBankProj/AddBloodInfo.php">Add Blood Info</a></li>';
                echo '<li><a href="/BloodBankProj/ViewRequest.php">View Request</a></li>';
                } 
                ?>
               <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            </ul>
         </div>
      </nav>
      <div class= "container-fluid">
         <div class="top-left">
            <p>There is a hope of life to someone in your blood donation</p>
         </div>
         <img src="Donate.gif" style="width:100%;">
      </div>
   </body>
</html>
