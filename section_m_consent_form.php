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
                    3.0 DBS Consent Form
                </div>               
            </div>
            <div>Section 5 of 6</div>
        </div>

        
        <!-- Title of post applied for //-->           
        <div class='flex flex-col text-sm py-8 items-center justify-center border-0 font-semibold'>
            <div class='text-2xl'>Are you signed up to the DBS Update Service?</div>
            <div class='text-2xl'>Yes OR No</div>
        </div>
       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    if ($status == 'fail')
                    {
                         echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                    }
                   
            ?>
            
            
            

            

            
            <label class='text-xl text-red-500 font-semibold'>NEW EMPLOYEES ONLY</label>

             <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- former surnames //-->
                <div class="py-3 md:w-full">
                    <label class='text-xl text-gray-800 font-semibold'>Yes</label>
                    
                    <div class="py-1">
                            <input name="signature" type='radio' required class="border py-3 rounded-md px-3 text-lg  
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            w-6 h-6" />&nbsp;&nbsp;  I declare that I am already signed up the DBS Update Service, I also understand that
in the event of signing the below, I am consenting that my employer, Moor and Coast Care, can process on-
going status checks as and when needed through the update service.
                    </div>
                </div>

               
            </div>
            <!-- End of Professional Qualifications currently held how obtained, grade and date  //-->




            <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mb-12">
                <!-- former surnames //-->
                <div class="py-3 md:w-full">
                    <label class='text-xl text-gray-800 font-semibold font-semibold'>No</label>
                    <div class="py-1">
                            <input name="signature" type='radio' required class="border py-3 rounded-md px-3 text-lg 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            w-6 h-6" />  &nbsp;&nbsp;I declare that I agree to sign up to the DBS Update Service for the fee of £13.00, the
cost of which will be met by myself. This money will be reimbursed to me by the company after successful
completion of my 6 month probationary period. <br/><br/>
I also understand that in the event of signing up the DBS Update service, I am consenting that my employer,
Moor and Coast Care, can process on-going status checks as and when needed through the update service.
                    </div>
                </div>

               
            </div>
            <!-- End of Professional Qualifications currently held how obtained, grade and date  //-->



            <label class='text-xl text-red-500 font-semibold'>EXISTING EMPLOYEES ONLY</label>

             <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- former surnames //-->
                <div class="py-3 md:w-full">
                    
                    
                    <div class="py-1">
                        I declare that I agree to sign up to the DBS Update Service for the fee of £13.00, the
cost of which will be met by myself. This money will be reimbursed to me by the company on completion of an
expenses claim form. <br/><br/>
I also understand that in the event of signing up the DBS Update service, I am consenting that my employer,
Moor and Coast Care, can process on-going status checks as and when needed through the update service.
                    </div>
                </div>

               
            </div>
            <!-- End of Professional Qualifications currently held how obtained, grade and date  //-->




                      

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