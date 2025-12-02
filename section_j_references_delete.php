<?php
  session_start();

  if (!isset($_GET['q']) && $_GET['q'] !='')
  {
        if ($_GET['u'] != $_SESSION['user_id'])
        {
            header("location:section_j_references.php");
        }

  }

  

  include_once('config/database.php');
  include_once('classes/PreviousEmployment.php');
  include_once('classes/InterviewReference.php');
  

  $status = "";
  $error_msg = "";

  $database = new Database();
  $db = $database->getConnection();

     

  $reference = new InterviewReference($db);
  $reference->id = $_GET['q'];

  $reference->delete(); 

  header("location:section_j_references.php");
        
  





  require_once('nav.inc.php');

?>

