<?php
   session_start();
   $_SESSION = [];
   if(isset($_SESSION["name"])){
       unset($_SESSION["name"]);
   }
   if(isset($_SESSION["type"])){
       unset($_SESSION["type"]);
   }
   if(isset($_SESSION["loggedin"])){
    unset($_SESSION["loggedin"]);
}
   session_destroy();
   header('Location:/BloodBankProj/Index.html');
   ?>
