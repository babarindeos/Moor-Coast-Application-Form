<?php
  session_start();
  if (!isset($_SESSION['login']) || $_SESSION['login'] != 'moor_coast_app')
  {
     header("Location: index.php");
  }

  $status = "";
  $error_msg = "";

  
  include_once('config/database.php');
  include_once('classes/User.php');
  include_once('classes/Education.php');
  include_once('classes/Profession.php');
  include_once('classes/TrainingCourse.php');
  include_once('classes/PresentPost.php');
  


   $database = new Database();
   $db = $database->getConnection();


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $user_id = $_SESSION['user_id'];
        $title_of_post = htmlspecialchars(strip_tags($_POST['title_of_post']));
        $grade = htmlspecialchars(strip_tags($_POST['grade']));
        $employer_name = htmlspecialchars(strip_tags($_POST['employer_name']));
        $employer_business = htmlspecialchars(strip_tags($_POST['employer_business']));
        $address = htmlspecialchars(strip_tags($_POST['address']));
        $date_commenced = htmlspecialchars(strip_tags($_POST['date_commenced']));
        $date_ended = htmlspecialchars(strip_tags($_POST['date_ended']));
        $responsibilities = htmlspecialchars(strip_tags($_POST['responsibilities']));
        $employer_name = htmlspecialchars(strip_tags($_POST['employer_name']));
        $leaving_reason = htmlspecialchars(strip_tags($_POST['leaving_reason']));
        $notice_period = htmlspecialchars(strip_tags($_POST['notice_period']));
        $interview_date = htmlspecialchars(strip_tags($_POST['interview_date']));
        $disciplinary_option = htmlspecialchars(strip_tags($_POST['disciplinary_option']));
        $disciplinary_details = htmlspecialchars(strip_tags($_POST['disciplinary_details']));



        $present_post = new PresentPost($db);

        $present_post->user_id = $user_id;
        $present_post->title_of_post = $title_of_post;
        $present_post->grade = $grade;
        $present_post->employer_name = $employer_name;
        $present_post->employer_business = $employer_business;
        $present_post->address = $address;
        $present_post->date_commenced = $date_commenced;
        $present_post->date_ended = $date_ended;
        $present_post->responsibilities = $responsibilities;
        $present_post->leaving_reason = $leaving_reason;
        $present_post->notice_period = $notice_period;
        $present_post->interview_date = $interview_date;
        $present_post->disciplinary_option = $disciplinary_option;
        $present_post->disciplinary_details =  $disciplinary_details;

       
        $exists = $present_post->exists();

        

        if ($exists->rowCount() )
        {
            
            $update = $present_post->update();
            if($update['status'])
            {
                $status = 'success';
                $error_msg = "The Present Post Information has been successfully updated";
            }
            else
            {
                $status = "fail";
                $error_msg = "An error occurred updating the Present Post Information";
            }
        }
        else
        {
            $create = $present_post->create();
            if($create['status'])
            {
                $status = 'success';
                $error_msg = "The Present Post Information has been successfully saved";
            }
            else
            {
                $status = "fail";
                $error_msg = "An error occurred saving the Present Post Information";
            }
        }
  }





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');


        $present_post = new PresentPost($db);
        $present_post->user_id = $_SESSION['user_id'];
        $present_post_record = $present_post->exists();
        $present_post = $present_post_record->fetch(PDO::FETCH_ASSOC);

        

    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 font-semibold  py-1 border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    PRESENT POST
                </div>
            </div>
            <div class="flex flex-col md:flex-col gap-2">
                <div>Section 3 of 6</div>
                <div>
                    <a href='section_b_educational_professional_qualifications.php' class='py-1 rounded-l px-5 bg-blue-500 text-white text-sm'>Previous</a>
                    <a href='section_d_previous_employment.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm'>Next</a>
                </div>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST')
                    {
                         if ($status == 'fail')
                         {
                                echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                         }
                         else 
                         {
                                echo "<div class='my-4 py-6 px-4 border border-green-200 bg-green-50 rounded-md'>{$error_msg}</div>";
                         }
                    }                          
                   
            ?>
            
            
            

            <!-- Title of Post and Grade //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-2/3">
                    <label class='text-gray-800 font-medium text-sm'>Title of Post Applied For: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="title_of_post" required  
                                   class="border py-3 rounded-md px-3 text-lg shadow-md 
                                   focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                   style="width:100%;"
                                   value="<?php if ($present_post != null){ echo $present_post['title_of_post']; } ?>"
                                   />
                    </div>
                </div>

                <div class="py-3 md:w-1/3">
                    <label class='text-gray-800 font-medium text-sm'>Grade: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="grade" 
                                   required class="border py-3 rounded-md px-3 text-lg 
                                   shadow-md focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                   style="width:100%;"
                                   value="<?php if ($present_post != null){ echo $present_post['grade']; } ?>"
                                   />
                    </div>
                </div>
            </div>
            <!-- End of Title of Post and Grade //-->



            <!-- Name of Employer //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-2/3">
                    <label class='text-gray-800 font-medium text-sm'>Name of Employer: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="employer_name" required  
                                               class="border py-3 rounded-md px-3 text-lg 
                                               shadow-md focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                               style="width:100%;" 
                                               value="<?php if ($present_post != null){ echo $present_post['employer_name']; } ?>"
                                               
                                               />
                    </div>
                </div>

                <div class="py-3 md:w-1/3">
                    <label class='text-gray-800 font-medium text-sm'>Business of Employer: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="employer_business" required 
                                   class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                style="width:100%;"
                                                value="<?php if ($present_post != null){ echo $present_post['employer_business']; } ?>"
                                                 />
                    </div>
                </div>
            </div>
            <!-- End of Name of Employer //-->           




            <!-- Address and Phone Nos //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Address: <sup class='text-red-600'>*</sup></label>
                    <div class="py-1">
                            <textarea name="address" required 
                                      class="border py-3 rounded-md px-3 text-lg shadow-md 
                                             focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" 
                                             style="width:100%;" ><?php if ($present_post != null){ echo $present_post['title_of_post']; } ?></textarea>
                    </div>
                </div>

                <div class="flex flex-col py-3 md:w-1/2 gap-y-2">
                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Date Commenced:  </label>
                            <div class='py-1'>
                                    <input type="text" name="date_commenced" 
                                            class="border py-3 md:py-2 rounded-md px-3 text-lg shadow-md focus:outline-none 
                                                   focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                   value="<?php if ($present_post != null){ echo $present_post['date_commenced']; } ?>"
                                                   />
                            </div>
                        </div>

                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Date Ended (if applicable):  </label>
                            <div class='py-1'>
                                    <input type="text" name="date_ended" 
                                                       class="border py-3 md:py-2 rounded-md px-3 text-md shadow-md 
                                                              focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                              style="width:100%;"
                                                              value="<?php if ($present_post != null){ echo $present_post['date_ended']; } ?>"
                                                              />
                            </div>
                        </div>                       
                </div>
            </div>
            <!-- End of Address and Phone //-->



            <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Please outline your responsibilities, to whom you are responsible and staff responsible to you (if applicable): <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="responsibilities" required 
                                      class="border py-3 rounded-md px-3 text-lg shadow-md 
                                             focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" 
                                             style="width:100%;" ><?php if ($present_post != null){ echo $present_post['responsibilities']; } ?></textarea>
                    </div>
            </div>


            <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Reason for leaving or wishing to leave: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" required name="leaving_reason" 
                                               class="border py-3 rounded-md px-3 text-lg shadow-md 
                                               focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                               style="width:100%;"
                                               value="<?php if ($present_post != null){ echo $present_post['leaving_reason']; } ?>"
                                               />
                    </div>
            </div>



            <!-- Email and Nat Insurance No. //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Period of notice required to terminate present employment: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="notice_period" required  
                                               class="border py-3 rounded-md px-3 text-lg shadow-md 
                                               focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                               style="width:100%;"
                                               value="<?php if ($present_post != null){ echo $present_post['notice_period']; } ?>"
                                               />
                    </div>
                </div>

                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Please notify us of any dates you are available for interview: <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="interview_date" 
                                               class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                      focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                      style="width:100%;"
                                                      value="<?php if ($present_post != null){ echo $present_post['interview_date']; } ?>"
                                                      />
                    </div>
                </div>
            </div>
            <!-- End of mail and Nat Insurance No. //-->



            <!-- work permit. //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Have you ever been involved in any disciplinary procedures?  <sup class='text-red-600'></sup></label>
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" name="disciplinary_option" required  
                                                    class="border py-3 rounded-md px-3 text-lg
                                                    focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                    <?php if ($present_post && $present_post['disciplinary_option']=='1'){ echo "checked"; } ?>
                                                    
                                                    /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="disciplinary_option" required  
                                                    class="border py-3 rounded-md px-3 text-lg
                                                    focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>If Yes, please provide details: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <textarea type="date" name="disciplinary_details" 
                                                  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                  focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-48" 
                                                  style="width:100%;" ><?php if ($present_post != null){ echo $present_post['disciplinary_details']; } ?></textarea>
                    </div>
                </div>
            </div>
            <!-- End of work permit //-->



            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
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