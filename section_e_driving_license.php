<?php
  include_once('page_config.inc.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $current_license = htmlspecialchars(strip_tags($_POST['current_license']));
        $car_access = htmlspecialchars(strip_tags($_POST['car_access']));
        $own_car = htmlspecialchars(strip_tags($_POST['own_car']));
        $insurance_policy = htmlspecialchars(strip_tags($_POST['insurance_policy']));
        $penaly_points = htmlspecialchars(strip_tags($_POST['penalty_points']));
        $driving_penalty = htmlspecialchars(strip_tags($_POST['driving_penalty']));
        $details = htmlspecialchars(strip_tags($_POST['details']));


        $driving_license = new DrivingLicense($db);

        
        $driving_license->user_id = $_SESSION['user_id'];

        $driving_license->current_license = $current_license;
        $driving_license->car_access = $car_access;
        $driving_license->own_car = $own_car;
        $driving_license->insurance_policy = $insurance_policy;
        $driving_license->penalty_points = $penaly_points;
        $driving_license->driving_penalty = $driving_penalty;
        $driving_license->details = $details;


        $record_exist = $driving_license->exists();
        
        if ($record_exist->rowCount() > 0)
        {
               $update = $driving_license->update($db);

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

        }
        else
        {
             $create =  $driving_license->create($db);   
             
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

             
             
        }

       

       
  }





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');


        $driving_license = new DrivingLicense($db);
        $driving_license->user_id = $_SESSION['user_id'];
        
        $driving_license = $driving_license->exists();
        $driving_license = $driving_license->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    DRIVING LICENSE
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 5 of 13</div>
                <div>
                    <a href='section_d_previous_employment.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_f_working_hours.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>
        </div>

        

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


             <?php
                    include_once('alert_message.inc.php');
             ?>
            
            
            <!-- Title of post applied for //-->           

            

            <!-- Do you have a current full driving license? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Do you have a current full driving license? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" <?php if ($driving_license['current_license'] == '1'){ echo 'checked'; } ?> name="current_license" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" <?php if ($driving_license['current_license'] == '0'){ echo 'checked'; } ?> name="current_license" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have a current full driving license? //-->


            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Do you have regular access to a car? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" <?php if ($driving_license['car_access'] == '1'){ echo 'checked'; } ?> name="car_access" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="car_access" <?php if ($driving_license['car_access'] == '0'){ echo 'checked'; } ?> required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Would you be happy to take clients out in your own car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Would you be happy to take clients out in your own car? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" name="own_car" <?php if ($driving_license['own_car'] == '1'){ echo 'checked'; } ?> required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="own_car" <?php if ($driving_license['own_car'] == '0'){ echo 'checked'; } ?> required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Would you be happy to take clients out in your own car? //-->



            <!-- Do you have business cover on your car insurance policy?  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Do you have business cover on your car insurance policy?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" name="insurance_policy" <?php if ($driving_license['insurance_policy'] == '1'){ echo 'checked'; } ?> required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="insurance_policy" required  <?php if ($driving_license['insurance_policy'] == '0'){ echo 'checked'; } ?>  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have business cover on your car insurance policy?  //-->



            <!-- Do you have any penalty points on your current driving license?  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Do you have any penalty points on your current driving license?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" name="penalty_points" required <?php if ($driving_license['penalty_points'] == '1'){ echo 'checked'; } ?>  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="penalty_points" required <?php if ($driving_license['penalty_points'] == '0'){ echo 'checked'; } ?>  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have any penalty points on your current driving license?  //-->


            <!-- Have you ever been disqualified from driving or had insurance refused?   //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Have you ever been disqualified from driving or had insurance refused?   <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" value="1" name="driving_penalty" required <?php if ($driving_license['driving_penalty'] == '1'){ echo 'checked'; } ?> class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"  /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" value="0" name="driving_penalty" required <?php if ($driving_license['driving_penalty'] == '0'){ echo 'checked'; } ?> class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Have you ever been disqualified from driving or had insurance refused?  //-->

     

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>If you have answered yes to been disqualified from driving or had insurance refused: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="details" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php echo $driving_license['details']; ?></textarea>
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