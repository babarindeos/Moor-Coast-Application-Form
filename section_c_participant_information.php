<?php

  session_start();
  
  if (!isset($_SESSION['login']) || $_SESSION['login'] != 'csa2025')
  {
     header("Location: section_a_participant_identification.php");
  }

  $status = "";
  $error_msg = "";

  include_once('config/database.php');
  include_once('classes/Category.php');
  include_once('classes/Participant.php');

  $database = new Database();
  $db = $database->getConnection();

  $participant = new Participant($db);
  $participant->user_id = $_SESSION['user_id'];
  $get_participant = $participant->get_participant();

  //var_dump($get_participant);
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {

        $prefix = htmlspecialchars(strip_tags($_POST['prefix']));
        $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
        $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
        $phone = htmlspecialchars(strip_tags($_POST['phone']));
        $institution = htmlspecialchars(strip_tags($_POST['institution']));
        $country = htmlspecialchars(strip_tags($_POST['country']));

        
        $get_participant = $participant->get_participant();
        $participant->prefix = $prefix;
        $participant->firstname = $firstname;
        $participant->lastname = $lastname;
        $participant->phone = $phone;
        $participant->institution = $institution;
        $participant->country = $country;
        
        if ($get_participant)
        {
            $participant->user_id = $_SESSION['user_id'];
            $update = $participant->update();
            header("Location: section_d_paper_information.php");
        }
        else
        {
            $create = $participant->create();
            header("Location: section_d_paper_information.php");
        }
        


  }


  require_once('nav.inc.php');
?>

<main class="bg-gray-100">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 bg-white px-5">
        <div class="text-2xl md:text-3xl text-green-800 font-semibold border-b py-2 border-gray-300">
            Conference Registration
        </div>
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center">
            <div class="text-lg md:text-xl text-black-500 font-semibold py-4 border-gray-300">
                Participant Information
            </div>
            <div class="flex flex-row justify-between border-0 gap-x-5">
                    <div>Section 3 of 6</div>
                    <div><a class='underline' href='section_b_participation_category.php'>Previous</a> <?php if ($get_participant){ echo "|  "."<a class='underline' href='section_d_paper_information.php'>Next</a>"; } ?>  </div> 
                    
            </div>
        </div>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">
            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Prefix <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="prefix" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                            value="<?php  if($get_participant && !(empty(trim($get_participant['prefix'])))){ echo $get_participant['prefix']; }   ?>" />
                </div>
            </div>

            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">First name <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="firstname" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_participant && !(empty(trim($get_participant['firstname'])))){ echo $get_participant['firstname']; }   ?>" />
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Last name <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="lastname" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                         value="<?php  if($get_participant && !(empty(trim($get_participant['lastname'] != '')))){ echo $get_participant['lastname']; }   ?>"/>
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Phone <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="phone" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;"
                         value="<?php  if($get_participant && !(empty(trim($get_participant['phone'])))){ echo $get_participant['phone']; }   ?>" />
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Institution <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="institution" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_participant && !(empty(trim($get_participant['institution'])))){ echo $get_participant['institution']; }   ?>" />
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Country <sup class='text-red-600'>*</sup></label>
                <div>
                        <input type="text" name="country" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_participant && !(empty(trim($get_participant['country'])))){ echo $get_participant['country']; }   ?>" />
                </div>
            </div>


            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white font-semibold hover:bg-green-600 cursor-pointer" 
                                style="width:100%;" >
                                Submit
                        </button>
                </div>
            </div>

           

        </form>

    </section>
</main>



<?php
    require_once('footer.inc.php');
?>