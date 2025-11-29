<?php
  session_start();

  if (!isset($_GET['q']) && $_GET['q'] !='')
  {
        if ($_GET['u'] != $_SESSION['user_id'])
        {
            header("location:section_d_previous_employment.php");
        }

  }

  

  include_once('config/database.php');
  include_once('classes/PreviousEmployment.php');

  $status = "";
  $error_msg = "";

  $database = new Database();
  $db = $database->getConnection();

     

  $previous_employment = new PreviousEmployment($db);
  $previous_employment->id = $_GET['q'];
  $previous_employment->user_id = $user_id;



  $previous_employment->delete(); 

  header("location:section_d_previous_employment.php");
        
  





  require_once('nav.inc.php');

?>

