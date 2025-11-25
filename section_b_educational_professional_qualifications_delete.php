<?php
    session_start();

    if (isset($_GET['q']) && $_GET['q'] !='')
    {
        if ($_GET['u'] == $_SESSION['user_id'])
        {
            include_once('config/database.php');
            include_once('classes/Education.php');
            include_once('classes/Profession.php');
            include_once('classes/TrainingCourse.php');

            $database = new Database();
            $db = $database->getConnection();
            

            if ($_GET['sec'] == 1)
            {
                $education = new Education($db);
                $education->id = $_GET['q'];
                $education->delete();
            }    
            
            if ($_GET['sec'] == 2)
            {
                $profession = new Profession($db);
                $profession->id = $_GET['q'];
                $profession->delete();
            }    


            if ($_GET['sec'] == 3)
            {
                $training_course = new TrainingCourse($db);
                $training_course->id = $_GET['q'];
                $training_course->delete();
            }    
            

            header("location:section_b_educational_professional_qualifications.php");

        }
        
    }
    else
    {
        header("location:section_b_educational_professional_qualifications.php");
    }
?>