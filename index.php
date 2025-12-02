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


    <section class="flex flex-col mx-5 md:mx-80 border-0 py-8 px-5 bg-white mt-5 rounded-md items-center justify-center">
        <div class='text-2xl md:text-3xl font-semibold'>Join Our Caring Team</div>
        <div class='text-center md:mx10 md:mx-20 py-3'>We're looking for compassionate individuals to join Moor & Coast Care Limited. Complete our online application form to start your journey with us.</div>
    </section>


    <section class="mx-5 md:mx-80 border-0 md:py-8 px-5 bg-white">
        <div class="flex flex-row text-center w-full items-center justify-center"><div class='p-4 border border-blue-100 rounded-full bg-blue-100'><i class="fa-regular fa-copy text-blue-500 font-semibold"></i></div></div>
        <div class='text-center text-xl md:text-2xl font-semibold'>Job Application Form</div>
        <div class='text-center'>This form is confidential and will be processed in accordance with the Data Protection Act 2018.</div>
        
        <div class='border md:mx-20 p-10 mt-5 rounded-md bg-blue-50 border-blue-50'>
            <div class="font-medium py-1">Before you begin:</div>
            <ul class='list-disc list-inside space-x-1'>
                
                    
                        <li>Please have your employment history ready (dating back to age 16)</li>
                        <li>You'll need details of at least two references</li>
                        <li>The form takes approximately 15-20 minutes to complete</li>
                        <li>All information will be stored securely</li>
            </ul>
        </div>

        <div class="flex flex-col md:flex-row mx-auto border w-full items-center justify-center py-5 border-0">
                <div class="border-0 md:space-x-2 space-y-2 md:space-y-0">
                    <a href="new_application_start.php" class="border rounded-md border px-5 md:px-6 py-3 text-white bg-blue-500 text-sm md:text-md hover:bg-blue-400">New Application</a> 
                    <a href="resume_application.php" class="border rounded-md border px-5 md:px-6 py-3 text-white bg-blue-500 text-sm md:text-md hover:bg-blue-400">Resume Application</a>
                </div>

        </div>


    </section>


    <section class="flex flex-col md:flex-row mx-5 md:mx-80 border-0 md:py-8 mt-8 mb-16 gap-y-2 gap-y-0">
        <div class="md:w-1/3 bg-white md:mr-3 p-6 mx-auto border-0 rounded-md">
                <div class="flex flex-row text-center w-full items-center justify-center"><div class='p-4 border border-green-100 rounded-md bg-green-100'><i class="fa-regular fa-heart text-green-500 font-semibold"></i></div></div>
                <div class="border-0 text-center text-sm font-semibold text-gray-900 py-2">Compassionate Care</div>
                <div class="text-center text-sm">
                    We provide high-quality domiciliary care services with empathy and professionalism.
                </div>
        </div>
        <div class="md:w-1/3 bg-white md:mx-3 p-6 mx-auto border-0 rounded-md">
            <div class="flex flex-row text-center w-full items-center justify-center"><div class='p-4 border border-blue-100 rounded-md bg-blue-100'><i class="fa-regular fa-copy text-blue-500 font-semibold"></i></div></div>
            <div class="border-0 text-center text-sm font-semibold text-gray-900 py-2">Flexible Hours</div>
            <div class="text-center text-sm">
                    Working hours from 6am to 10pm, Monday to Sunday, with flexible scheduling options.
            </div>
        </div>
        <div class="md:w-1/3 bg-white md:ml-3 p-6 mx-auto border-0 rounded-md">
            <div class="flex flex-row text-center w-full items-center justify-center"><div class='p-4 border border-purple-100 rounded-md bg-purple-100'><i class="fa-solid fa-users text-purple-500 font-semibold"></i></div></div>
            <div class="border-0 text-center text-sm font-semibold text-gray-900 py-2">Professional Growth</div>
            <div class="text-center text-sm">
                    Working hours from 6am to 10pm, Monday to Sunday, with flexible scheduling options.
            </div>
        </div>

    </section>

    <br/><br/><br/>


</main>



<?php
    require_once('footer.inc.php');
?>