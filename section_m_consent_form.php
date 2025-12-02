<?php

  include_once("page_config.inc.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        
        $subscribe = htmlspecialchars(strip_tags((string) $_POST['subscribe']));
          

        //echo $other_activities;        
        
        $dbs = new DBSService($db);

        
        $dbs->user_id = $_SESSION['user_id'];

        $dbs->subscribe = $subscribe;
        
              

        $record_exist = $dbs->exists();
        
        if ($record_exist->rowCount() > 0)
        {
                $update =  $dbs->update($db);

                if ($update['status']=="success")
                {
                        $status = "success";
                        $error_msg = "The record has been successfully updated";           
                }
                else
                {
                        $status = "fail";
                        $error_msg = "An error occurred updating the record";

                }

            header("location: application_completed.php");
        }
        else
        {
             $create =  $dbs->create($db);   
             
            if ($create['status']=="success")
                {

                        $status = "success";
                        $error_msg = "The record has been successfully saved";           
            }
            else
            {
                        $status = "fail";
                        $error_msg = "An error occurred saving the record";

            }

             
             header("location: application_completed.php");
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
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    3.0 DBS Consent Form
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 13 of 13</div>
                <div>
                    <a href='section_l_declaration.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    

                </div>
            </div>
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
                            <input name="subscribe" type='radio' value='new_yes' required class="border py-3 rounded-md px-3 text-lg  
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
                            <input name="subscribe" type='radio' value="new_no" required class="border py-3 rounded-md px-3 text-lg 
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
                        <input name="subscribe" type='radio' value="old_yes" required class="border py-3 rounded-md px-3 text-lg 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            w-6 h-6" />  &nbsp;&nbsp;
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
                                FINAL SUBMISSION
                        </button>
                </div>
            </div>



           

        </form>

    </section>
</main>



<?php
    require_once('footer.inc.php');
?>