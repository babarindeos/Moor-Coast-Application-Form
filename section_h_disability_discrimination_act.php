<?php
  session_start();
  session_destroy();

  $status = "";
  $error_msg = "";


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $confirm_email = htmlspecialchars(strip_tags($_POST['confirm_email']));

       

        if ($email != $confirm_email)
        {
            $status = "fail";
            $error_msg = "The email addresses do not match.";
        }
        else
        {
            include_once('config/database.php');
            include_once('classes/User.php');

            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            $user->email = $email;
            $user_exist = $user->user_exist();

            //var_dump($user_exist);
            //exit;

            if ($user_exist == 0)
            {
                 $user_create = $user->create();
                 if ($user_create['status']=="success")
                 {

                         $user_exist = $user->user_exist();
                         session_start();
                         $_SESSION['login'] = 'csa2025';
                         $_SESSION['user_email'] = $user_exist['email'];
                         $_SESSION['user_id'] = $user_exist['user_id'];

                         header("Location:section_b_participation_category.php");
                 }
                 else
                 {
                        $status = "fail";
                        $error_msg = "An error occurred registering the email";
                 }
            }
            else
            {
                 session_start();
                 $_SESSION['login'] = 'csa2025';
                 $_SESSION['user_email'] = $user_exist['email'];
                 $_SESSION['user_id'] = $user_exist['user_id'];
                 header("Location:section_b_participation_category.php");
            }
        }
  }





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-0 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    DISABILITY DISCRIMINATION ACT 1995
                </div>               
            </div>
            <div>Section 5 of 6</div>
        </div>

        

       
        

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    if ($status == 'fail')
                    {
                         echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                    }
                   
            ?>
            
            
        

            

            



            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           How many hours a week would you ideally want to work. (If unsure state full time or part time)?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           If Yes, are there any adjustments that you think we could make to overcome a disability in relation to the essential requirements of this job? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Would you be happy to take clients out in your own car? //-->
            <div class="flex flex-col md:flex-col w-full gap-x-4 border-b mt-4 border-gray-400">
                <label class='text-gray-800 font-medium text-sm'>If Yes, what assistance/adaptations do you require?: <sup class='text-red-600'></sup></label>

                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="flex py-1 border-0">
                                 <textarea name="grade" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" ></textarea>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Would you be happy to take clients out in your own car? //-->



            <!-- Do you have business cover on your car insurance policy?  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           If selected for interview, do you require any assistance/adaptations to help you attend?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="need_work_permit" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have business cover on your car insurance policy?  //-->



            

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>If Yes, what assistance/adaptations do you require?: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="duties_description" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ></textarea>
                    </div>
                </div>

                
            </div>
            <!-- End of Description of duties //-->


            
            

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