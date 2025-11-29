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
  include_once('classes/PersonalDetail.php');


   $database = new Database();
   $db = $database->getConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {

        $personal_details = new PersonalDetail($db);

        $personal_details->post_title = htmlspecialchars(strip_tags($_POST['post_title']));
        $personal_details->surname = htmlspecialchars(strip_tags($_POST['surname']));
        $personal_details->forenames = htmlspecialchars(strip_tags($_POST['forenames']));
        $personal_details->former_surnames = htmlspecialchars(strip_tags($_POST['former_surnames']));
        $personal_details->address = htmlspecialchars(strip_tags($_POST['address']));
        $personal_details->home_phone = htmlspecialchars(strip_tags($_POST['home_phone']));
        $personal_details->business_phone = htmlspecialchars(strip_tags($_POST['business_phone']));
        $personal_details->mobile_phone = htmlspecialchars(strip_tags($_POST['mobile_phone']));
        $personal_details->fax_no = htmlspecialchars(strip_tags($_POST['fax_no']));
        $personal_details->email = $_SESSION['user_email'];
        $personal_details->nat_insurance_no = htmlspecialchars(strip_tags($_POST['nat_insurance_no']));
        $personal_details->need_work_permit = htmlspecialchars(strip_tags($_POST['need_work_permit']));
        $personal_details->permit_expire_date = htmlspecialchars(strip_tags($_POST['permit_expire_date']));
         
       

        $personal_details->user_id = $_SESSION['user_id'];

        //echo $personal_details->user_id;
        $personal_details_exists = $personal_details->personal_details_exist();

        

        if ($personal_details_exists)
        {

            $update = $personal_details->update();
            if ($update['status'] == 'fail')
            {
                $status = "fail";
                $error_msg = "An error occured updating the Personal Details";
            }
            else
            {
                $status = 'success';
                $error_msg = "The Personal Details has been successfully updated.";
            }
            
        }
        else
        {
            $update = $personal_details->create();
            if ($update['status'] == 'fail')
            {
                $status = "fail";
                $error_msg = "An error occured saving the Personal Details";
            }
            else
            {
                $status = 'success';
                $error_msg = "The Personal Details has been successfully saved.";
            }

            
        }
  }





  require_once('nav.inc.php');



?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');

        $personal_details = new PersonalDetail($db);
        $personal_details->user_id = $_SESSION['user_id'];
        $personal_details = $personal_details->personal_details_exist();
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 font-semibold py-1 border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                        PERSONAL DETAILS
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-2">
                <div>Section 1 of 6</div> 
                <?php 
                    if ($personal_details){
                ?>
                    <div><a href='section_b_educational_professional_qualifications.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm'>Next</a></div>
                <?php
                    }
                ?>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    include_once('alert_message.inc.php');
            ?>
            
            
            <!-- Title of post applied for //-->
            <div class="py-3">
                    <label class='text-gray-800 font-medium text-sm'>Title of post applied for: <sup class='text-red-600'>*</sup></label>
                    <div class="py-1">
                            <input type="text" name="post_title" required  class="focus:outline-none focus:ring-1 focus:ring-sky-300/50 
                                                                             focus:border-sky-400 border py-3 rounded-md px-3 text-lg shadow-md" 
                                                                             style="width:100%;" 
                                                                             value="<?php if ($personal_details){ echo $personal_details['post_title']; } ?>"/>
                    </div>
            </div>


            <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center">
               
            </div>

            <!-- Surname and Forenames //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Surname: <sup class='text-red-600'>*</sup></label>
                    <div class="py-1">
                            <input type="text" name="surname" required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                         style="width:100%;" 
                                                                         value="<?php if ($personal_details){ echo $personal_details['surname']; } ?>"/>
                    </div>
                </div>

                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Forenames <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="forenames" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                style="width:100%;"
                                                                                value="<?php if ($personal_details){ echo $personal_details['forenames']; } ?>" />
                    </div>
                </div>
            </div>
            <!-- End of Surname and Forenames //-->


            <!-- former surnames //-->
            <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Former surnames if different: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="former_surnames"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                         style="width:100%;" 
                                                                         value="<?php if ($personal_details){ echo $personal_details['former_surnames']; } ?>"/>
                    </div>
            </div>




            <!-- Address and Phone Nos //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Address: <sup class='text-red-600'>*</sup></label>
                    <div class="py-1">
                            <textarea name="address" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-48 md:h-69"
                                                                         style="width:100%;" ><?php if ($personal_details){ echo $personal_details['address']; } ?></textarea>
                    </div>
                </div>

                <div class="flex flex-col py-3 md:w-1/2 gap-y-2">
                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Tel No (home):  </label>
                            <div class='py-1'>
                                    <input type="text" name="home_phone" required class="border py-3 md:py-2 rounded-md px-3 text-lg shadow-md 
                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                        style="width:100%;"
                                                                                        value="<?php if ($personal_details){ echo $personal_details['home_phone']; } ?>" />
                            </div>
                        </div>

                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Tel No (business):  </label>
                            <div class='py-1'>
                                    <input type="text" name="business_phone" class="border py-3 md:py-2 rounded-md px-3 text-md shadow-md 
                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                        style="width:100%;"
                                                                                        value="<?php if ($personal_details){ echo $personal_details['business_phone']; } ?>" />
                            </div>
                        </div>


                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Tel No (mobile):  </label>
                            <div class='py-1'>
                                    <input type="text" name="mobile_phone" required class="border py-3 md:py-2 rounded-md px-3 text-md shadow-md 
                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                        style="width:100%;"
                                                                                        value="<?php if ($personal_details){ echo $personal_details['mobile_phone']; } ?>" />
                            </div>
                        </div>

                        <div>
                            <label class='text-gray-800 font-medium text-sm'>Fax No.:  </label>
                            <div class='py-1'>
                                    <input type="text" name="fax_no" class="border py-3 md:py-2 rounded-md px-3 text-md shadow-md 
                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" \
                                                                                        style="width:100%;" 
                                                                                        value="<?php if ($personal_details){ echo $personal_details['fax_no']; } ?>" />
                            </div>
                        </div>
                </div>
            </div>
            <!-- End of Address and Phone //-->



            <!-- Email and Nat Insurance No. //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>E-Mail address: <sup class='text-red-600'>*</sup></label>
                    <div class="py-1">
                            <input type="email" name="email" required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                         style="width:100%;"
                                                                         value="<?php if ($personal_details){ echo $personal_details['email']; } ?>" />
                    </div>
                </div>

                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Nat. Insurance No: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="nat_insurance_no" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                style="width:100%;"
                                                                                value="<?php if ($personal_details){ echo $personal_details['nat_insurance_no']; } ?>" />
                    </div>
                </div>
            </div>
            <!-- End of mail and Nat Insurance No. //-->



            <!-- work permit. //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>Do you need a work permit to be employed in the UK? <sup class='text-red-600'>*</sup></label>
                    <div class="flex py-1 border-0">
                                <input type="radio" name="need_work_permit" value='1' required  class="border py-3 rounded-md px-3 text-lg  
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6" 
                                                                         <?php if ($personal_details && $personal_details['need_work_permit']=='1'){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="need_work_permit" value='0' required  class="border py-3 rounded-md px-3 text-lg 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3" 
                                                                         <?php if ($personal_details && $personal_details['need_work_permit']=='0'){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                <div class="py-3 md:w-1/2">
                    <label class='text-gray-800 font-medium text-sm'>If you already have a work permit, when does it expire?  (Please note that your current work permit may not be valid for this post.) <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="date" name="permit_expire_date" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" 
                                                                                style="width:100%;"
                                                                                value="<?php if ($personal_details){ echo $personal_details['permit_expire_date']; } ?>" />
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