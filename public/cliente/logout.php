<?php 
  session_start();
  if(!isset($_SESSION['userid'])){
      header("location:../index.php");
      die();
  }  

  if(session_destroy()) {
      header("Location:../index.php");
   }
 ?>