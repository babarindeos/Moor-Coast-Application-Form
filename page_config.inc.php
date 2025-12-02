<?php
session_start();

  if (!isset($_SESSION['login']) || $_SESSION['login'] != 'moor_coast_app')
  {
     header("Location: index.php");
  }


  
  include_once('config/database.php');
  include_once('classes/PersonalDetail.php');
  include_once('classes/User.php');
  include_once('classes/Education.php');
  include_once('classes/Profession.php');
  include_once('classes/TrainingCourse.php');
  include_once('classes/PresentPost.php');
  include_once('classes/PreviousEmployment.php');
  include_once('classes/DrivingLicense.php');
  include_once('classes/WorkingHour.php');
  include_once('classes/OtherInformation.php');
  include_once('classes/DisabilityAct.php');
  include_once('classes/Rehabilitation.php');
  include_once('classes/InterviewReference.php');
  include_once('classes/Consent.php');
  include_once('classes/Declaration.php');
  include_once('classes/DBSService.php');

  $status = "";
  $error_msg = "";

  $database = new Database();
  $db = $database->getConnection();


  $user = new User($db);
  $user->user_id = $_SESSION['user_id'];
  $complete_check = $user->application_complete();

  if ($complete_check != null)
  {
      header("location: application_completed.php");
  }

 
  ?>