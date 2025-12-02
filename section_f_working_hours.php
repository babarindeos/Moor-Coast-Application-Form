<?php
  include_once('page_config.inc.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $work_hours = htmlspecialchars(strip_tags($_POST['work_hours']));
        $impromptu_work = htmlspecialchars(strip_tags($_POST['impromptu_work']));
        $start_date = htmlspecialchars(strip_tags($_POST['start_date']));
        $employer_notice = htmlspecialchars(strip_tags($_POST['employer_notice']));
        $other_work = htmlspecialchars(strip_tags($_POST['other_work']));
        $future_holiday = htmlspecialchars(strip_tags($_POST['future_holiday']));
       


        $working_hour = new WorkingHour($db);

        
        $working_hour->user_id = $_SESSION['user_id'];

        $working_hour->work_hours = $work_hours;
        $working_hour->impromptu_work = $impromptu_work;
        $working_hour->start_date = $start_date;
        $working_hour->employer_notice = $employer_notice;
        $working_hour->other_work = $other_work;
        $working_hour->future_holiday = $future_holiday;
        


        $record_exist = $working_hour->exists();
        
        if ($record_exist->rowCount() > 0)
        {
               $update = $working_hour->update($db);

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
             $create =  $working_hour->create($db);   
             
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

        $working_hour = new WorkingHour($db);
        $working_hour->user_id = $_SESSION['user_id'];
        
        $working_hour = $working_hour->exists();
        $working_hour = $working_hour->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    WORKING HOURS
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 6 of 13</div>
                <div>
                    <a href='section_e_driving_license.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_g_other_information.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


             <?php
                    include_once('alert_message.inc.php');
             ?>
            
            
            <!-- Title of post applied for //-->           
            <div class='text-sm'>
                Our working hours are 6am through to 10.00pm Monday through to Sunday. Our busy times are early mornings, evenings and
                weekends and you will need to be able to work regularly at some of these times in order to be a domiciliary carer.
            </div>

            

            <!-- Do you have a current full driving license? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           How many hours a week would you ideally want to work. (If unsure state full time or part time)? 
                           <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-2/5">
                    
                         <input type="text" name="work_hours" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if ($working_hour){ echo $working_hour['work_hours']; } ?>"
                                                                                />
                                                                         
                </div>
                

                
            </div>
            <!-- End of Do you have a current full driving license? //-->


            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           From time to time we expect you to pick up work at short notice within your agreed availability. Will this be a problem for you? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-2/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="impromptu_work" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                                         <?php if ($working_hour && $working_hour['impromptu_work'] == "1"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="impromptu_work" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"  
                                                                         <?php if ($working_hour && $working_hour['impromptu_work'] == "0"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Would you be happy to take clients out in your own car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           When would you be available to start work from? <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-2/5">
                    
                    <div class="flex py-1 border-0">
                                 <input type="text" name="start_date" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if($working_hour){echo $working_hour['start_date']; } ?>"
                                                                                />

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Would you be happy to take clients out in your own car? //-->



            <!-- Do you have business cover on your car insurance policy?  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           How much notice do you need to give your current employer?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-2/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="employer_notice" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if($working_hour){echo $working_hour['employer_notice']; } ?>"
                                                                                />

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have business cover on your car insurance policy?  //-->



            

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Please give details of any other work you will continue to undertake if you are offered the job position: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="other_work" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if($working_hour){echo $working_hour['other_work']; } ?></textarea>
                    </div>
                </div>

                
            </div>
            <!-- End of Description of duties //-->


            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Please provide details of any future holidays or time off that you have already committed to. <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="future_holiday" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if($working_hour){echo $working_hour['future_holiday']; } ?></textarea>
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