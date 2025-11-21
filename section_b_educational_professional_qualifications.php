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
                <div class="text-xl md:text-xl text-green-800 font-semibold  py-1 border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    EDUCATIONAL AND PROFESSIONAL QUALIFICATION
                </div>
            </div>
            
            <div>Section 2 of 6</div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    if ($status == 'fail')
                    {
                         echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                    }
                   
            ?>
            
            
           

            

            <!-- SEDUCATIONAL AND PROFESSIONAL QUALIFICATION //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Secondary School/ College/ University <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="surname" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>From <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="forenames"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>To <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="forenames" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>
            </div>
            <!-- End of EDUCATIONAL AND PROFESSIONAL QUALIFICATION //-->

            <div class="py-3">
                
                <div>
                        <input  type="submit" name="btn_educational" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
                                style="width:100%;" value="Submit" >
                                
                        
                </div>
            </div>

        </form>



        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">            


            <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- former surnames //-->
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Professional Qualifications currently held how obtained: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="surname" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            h-24 md:h-24" style="width:100%;" ></textarea>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Grade <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="grade"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="date" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
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

            
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">
            

            <!-- Other relevant Educational or Training Courses and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- Other relevant Educational or Training Courses //-->
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'>Other relevant Educational or Training Courses: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="surname"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            h-24 md:h-24" style="width:100%;" ></textarea>
                    </div>
                </div>

                

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="date" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>
            </div>
            <!-- End of Other relevant Educational or Training Courses and date  //-->


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