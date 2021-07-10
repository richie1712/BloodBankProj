<!DOCTYPE html>
<html>
   <head>
      <title>View Request</title>
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
               <li><a href="/BloodBankProj/AddBloodInfo.php ">Add Blood Info</a></li>
               <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            </ul>
         </div>
      </nav>
   </body>
</html>
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
            // Create connection
            $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            // Check connection
            if ($db->connect_error) {
              die("Connection failed: " . $db->connect_error);
            }
            $sql = sprintf("SELECT * FROM bloodrequest");
            $result = $db->query($sql); 
            echo '<h1>Request Made to Your Hospital</h1><br>';
            if ($result->num_rows > 0) {
                echo "<table class='table'><tr><th><b>Requested By<b></th><th><b>Requested To</b></th><th><b>Blood Type</b></th></tr>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Receiver"]. "</td><td>" . $row["Hospital"]. "</td><td>" . $row["BloodType"]. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $db->close(); 
            ?>