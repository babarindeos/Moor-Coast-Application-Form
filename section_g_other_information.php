<?php
  include_once('page_config.inc.php');


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $other_activities = htmlspecialchars(strip_tags((string) $_POST['other_activities']));

        //echo $other_activities;        
        
        $other_information = new OtherInformation($db);

        
        $other_information->user_id = $_SESSION['user_id'];

        $other_information->other_activities = $other_activities;
        

        $record_exist = $other_information->exists();
        
        if ($record_exist->rowCount() > 0)
        {
               $update = $other_information->update($db);

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
             $create =  $other_information->create($db);   
             
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

        $other_information = new OtherInformation($db);
        $other_information->user_id = $_SESSION['user_id'];
        
        $other_information = $other_information->exists();
        $other_information = $other_information->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    OTHER INFORMATION
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 7 of 13</div>
                <div>
                    <a href='section_f_working_hours.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_h_disability_discrimination_act.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


             <?php
                    include_once('alert_message.inc.php');
             ?>
            
            
            
                       

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>What activities outside work interest you? (State any positions held you consider relevant.): <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="other_activities" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if ($other_information){ echo $other_information['other_activities']; } ?></textarea>
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