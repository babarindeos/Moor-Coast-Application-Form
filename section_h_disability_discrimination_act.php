<?php
  
  include_once('page_config.inc.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $disabled = htmlspecialchars(strip_tags((string) $_POST['disabled']));
        $overcome_disability = htmlspecialchars(strip_tags((string) $_POST['overcome_disability']));
        $further_details = htmlspecialchars(strip_tags((string) $_POST['further_details']));
        $interview_assistance = htmlspecialchars(strip_tags((string) $_POST['interview_assistance']));
        $required_assistance = htmlspecialchars(strip_tags((string) $_POST['required_assistance']));
        

        //echo $other_activities;        
        
        $disability_act = new DisabilityAct($db);

        
        $disability_act->user_id = $_SESSION['user_id'];

        $disability_act->disabled = $disabled;
        $disability_act->overcome_disability = $overcome_disability;
        $disability_act->further_details = $further_details;
        $disability_act->interview_assistance = $interview_assistance;
        $disability_act->required_assistance = $required_assistance;
        

        $record_exist = $disability_act->exists();
        
        if ($record_exist->rowCount() > 0)
        {
                $update =  $disability_act->update($db);

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
             $create =  $disability_act->create($db);   
             
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


        $disability_act = new DisabilityAct($db);
        $disability_act->user_id = $_SESSION['user_id'];
        
        $disability_act = $disability_act->exists();
        $disability_act = $disability_act->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    DISABILITY DISCRIMINATION ACT 1995
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 8 of 13</div>
                <div>
                    <a href='section_g_other_information.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_i_rehabilitation_offenders_act.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>
        </div>

        

       
        

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    include_once('alert_message.inc.php');
            ?>

            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Do you consider yourself to be disabled under the Disability Discrimination Act? ?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="disabled" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                                         <?php if ($disability_act && $disability_act['disabled'] == "1"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="disabled" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"
                                                                         <?php if ($disability_act && $disability_act['disabled'] == "0"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
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
                                <input type="radio" name="overcome_disability" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6" 
                                                                         <?php if ($disability_act && $disability_act['overcome_disability'] == "1"){ echo "checked"; } ?>                                                                         
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="overcome_disability" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3" 
                                                                         <?php if ($disability_act && $disability_act['overcome_disability'] == "0"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Would you be happy to take clients out in your own car? //-->
            <div class="flex flex-col md:flex-col w-full gap-x-4 border-b mt-4 border-gray-400">
                <label class='text-gray-800 font-medium text-sm'>If Yes, please provide further details: <sup class='text-red-600'></sup></label>

                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="flex py-1 border-0">
                                 <textarea name="further_details" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" ><?php if ($disability_act){ echo  $disability_act['further_details']; } ?></textarea>

                            
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
                                <input type="radio" name="interview_assistance" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6" 
                                                                         <?php if ($disability_act && $disability_act['interview_assistance'] == "1"){ echo "checked"; } ?>                                                                         
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="interview_assistance" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3" 
                                                                         <?php if ($disability_act && $disability_act['interview_assistance'] == "0"){ echo "checked"; } ?>  
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have business cover on your car insurance policy?  //-->



            

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>If Yes, what assistance/adaptations do you require?: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="required_assistance" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if ($disability_act){ echo  $disability_act['required_assistance']; } ?>  </textarea>
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