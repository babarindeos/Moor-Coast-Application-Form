<?php
  session_start();
  session_destroy();

  $status = "";
  $error_msg = "";


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $pin = htmlspecialchars(strip_tags($_POST['pin']));
        $confirm_pin = htmlspecialchars(strip_tags($_POST['confirm_pin']));

       

        if ($pin != $confirm_pin)
        {
            $status = "fail";
            $error_msg = "The PINs do not match. Please try again.";
        }
        else
        {
            include_once('config/database.php');
            include_once('classes/User.php');

            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            $user->email = $email;
            $user->pin = $pin;
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
                         $_SESSION['login'] = 'moor_coast_app';
                         $_SESSION['user_email'] = $user_exist['email'];
                         $_SESSION['user_id'] = $user_exist['user_id'];

                         header("Location:section_a_personal_details.php");
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
                 $_SESSION['login'] = 'moor_coast_app';
                 $_SESSION['user_email'] = $user_exist['email'];
                 $_SESSION['user_id'] = $user_exist['user_id'];
                 header("Location:section_a_personal_details.php");
            }
        }
  }





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="flex flex-col mx-5 md:mx-80 border-0 py-8 px-5 bg-white mt-5  items-center justify-center">
        <div class='text-2xl md:text-3xl font-semibold'>New Application</div>
        <div class='text-center md:mx10 md:mx-20 py-3'></div>
    </section>


    <section class="flex flex-col  mx-5 md:mx-80 border-0 md:py-8 px-5 bg-white">
        
            <div class="mx-5 md:mx-50 mb-8">
                <form action="<?php $_SERVER['PHP_SELF'];  ?>" method="POST">
                         <?php
                                    if ($status == 'fail')
                                    {
                                        echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                                    }
                                
                          ?>
            
            
                        <!-- Email //-->
                        <div class="py-3 border-0">
                                <label class='text-gray-800 font-medium text-md'>Email: <sup class='text-red-600'>*</sup></label>
                                <div class="py-1">
                                        <input type="email" name="email" required  class="focus:outline-none focus:ring-1 focus:ring-sky-300/50 
                                                                                        focus:border-sky-400 border py-3 rounded-md px-3 text-lg shadow-md" style="width:100%;" />
                                </div>
                        </div>
                        <!-- Email //-->

                         <!-- PIN //-->
                        <div class="py-3">
                                <label class='text-gray-800 font-medium text-md'>PIN: <sup class='text-red-600'>*</sup></label>
                                <div class="py-1">
                                        <input type="text" name="pin" required  maxlength='4' class="focus:outline-none focus:ring-1 focus:ring-sky-300/50 
                                                                                        focus:border-sky-400 border py-3 rounded-md px-3 text-lg shadow-md" style="width:100%;" />
                                </div>
                        </div>
                        <!-- PIN //-->


                         <!-- PIN //-->
                        <div class="py-3">
                                <label class='text-gray-800 font-medium text-md'>Confirm PIN: <sup class='text-red-600'>*</sup></label>
                                <div class="py-1">
                                        <input type="text" name="confirm_pin" required maxlength='4'  class="focus:outline-none focus:ring-1 focus:ring-sky-300/50 
                                                                                        focus:border-sky-400 border py-3 rounded-md px-3 text-lg shadow-md" style="width:100%;" />
                                </div>
                        </div>
                        <!-- PIN //-->


                        <!-- Button  //-->
                        <div class="py-3">
                
                            <div>
                                    <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white 
                                                                font-semibold hover:bg-green-600 cursor-pointer" 
                                            style="width:100%;" >
                                            Submit
                                    </button>
                            </div>
                        </div>
                        <!-- end of Button //-->


                        

                </form>
            </div>

    </section>


    

    <br/><br/><br/>


</main>



<?php
    require_once('footer.inc.php');
?>