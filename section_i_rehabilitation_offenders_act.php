<?php
  
  include_once("page_config.inc.php");


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $convicted = htmlspecialchars(strip_tags((string) $_POST['convicted']));
        $details = htmlspecialchars(strip_tags((string) $_POST['details']));
       
        

        //echo $other_activities;        
        
        $rehabilitation = new Rehabilitation($db);

        
        $rehabilitation->user_id = $_SESSION['user_id'];

        $rehabilitation->convicted = $convicted;
        $rehabilitation->details = $details;
              

        $record_exist = $rehabilitation->exists();
        
        if ($record_exist->rowCount() > 0)
        {
                $update =  $rehabilitation->update($db);

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
             $create =  $rehabilitation->create($db);   
             
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

        $rehabilitation = new Rehabilitation($db);
        $rehabilitation->user_id = $_SESSION['user_id'];
        
        $rehabilitation = $rehabilitation->exists();
        $rehabilitation = $rehabilitation->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    REHABILITATION OF OFFENDERS ACT 1974
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 9 of 13</div>
                <div>
                    <a href='section_h_disability_discrimination_act.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_j_references.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
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
                By virtue of the Rehabilitation of Offenders Act 1974 (Exceptions) Order 1975, the provisions of Section 4.2 of the rehabilitation of Offenders Act 1974 do not apply to any employment which is concerned with the provision of health
                services and which is of such a kind as to enable the holder to have access to persons in receipt of such services in the course of his normal duties. Your answer to the following questions should include any “spent” convictions.
            </div>

            

            


            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Have you ever been convicted/caution of a criminal offence?  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="radio" name="convicted" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                                         <?php if ($rehabilitation && $rehabilitation['convicted'] == "1"){ echo 'checked'; } ?>
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="convicted" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"
                                                                         <?php if ($rehabilitation && $rehabilitation['convicted'] == "0"){ echo 'checked'; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->


            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>If the answer is ‘yes’ please attach details. Including dates. <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="details" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if ($rehabilitation){ echo $rehabilitation['details']; } ?></textarea>
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