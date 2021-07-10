<!DOCTYPE html>
<html>
   <head>
      <title>Available Blood Sample</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
               <li><a href="/BloodBankProj/Welcome.php">Blood Bank</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
            session_start(); 
            if ($_SESSION["type"] === "hospital")  {
                echo '<li><a href="/BloodBankProj/AddBloodInfo.php">Add Blood Info</a></li>
                <li><a href="/BloodBankProj/ViewRequest.php">View Request</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
                } 
                if ($_SESSION["type"] == 'receiver') {
                  echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>';
                  } 
                ?>
               
            </ul>
         </div>
      </nav>
   </body>
</html>
<?php
   require 'config.inc.php';
      $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
      if ($db->connect_error) {
          die("Connection failed: " . $db->connect_error);
      }
      $sql = sprintf("SELECT * FROM bloodavailable");
      $result = $db->query($sql);
      echo '<h1>List of blood sample available</h1><br>';
       if ($result->num_rows > 0) {
          echo "<table class='table' id='table'><thead>
             <th><b>Hospital<b></th>
             <th><b>BloodType</b></th>
             </thead>";
          // output data of each row
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                 <td >" .
                  $row["Hospital"] .
                  "</td>
                 <td>" .
                  $row["BloodType"] .
                  '</td>
                 <td><input type="button" id="tst" value="Request Sample" onclick="fnselect()" /></td>
                 </tr>';
          }
          echo "</table>";
      } else {
          echo "0 results";
      }
      $db->close();
      ?>
