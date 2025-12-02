<?php

  include_once("page_config.inc.php");


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $name = htmlspecialchars(strip_tags((string) $_POST['name']));
        $date = htmlspecialchars(strip_tags((string) $_POST['date']));
       
        

        //echo $other_activities;        
        
        $consent = new Consent($db);

        
        $consent->user_id = $_SESSION['user_id'];

        $consent->name = $name;
        $consent->date = $date;
              

        $record_exist = $consent->exists();
        
        if ($record_exist->rowCount() > 0)
        {
                $update =  $consent->update($db);

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
             $create =  $consent->create($db);   
             
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

        $consent = new Consent($db);
        $consent->user_id = $_SESSION['user_id'];
        
        $consent = $consent->exists();
        $consent = $consent->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    CONSENT
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 11 of 13</div>
                <div>
                    <a href='section_j_references.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <?php
                        if ($consent){
                    ?>                     
                    <a href='section_l_declaration.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                    <?php  
                        }
                    ?>

                </div>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


            <?php
                    include_once('alert_message.inc.php');
            ?>
            
            
            <!-- Title of post applied for //-->           
            <div class='text-sm'>
                I give permission for Moor and Coast Care Ltd to collect (getting your information from someone) and store your personal information in line with the data protection Act 2018. 
                All personal data acquired by Moor and Coast Care shall only be used for the purposes of this Agreement and shall not be further processed or disclosed without the
consent of the applicant.
            </div>

            

            


             <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                

                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Name <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="name" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if ($consent){ echo $consent['name']; } ?>"
                                                                                />
                    </div>
                </div>

                 <div class="py-3 md:w-/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="date" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if ($consent){ echo $consent['date']; } ?>"
                                                                                />
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



            <!-- Title of post applied for //-->           
            <div class='text-sm mt-5'>
                The information provided by you on this form as an applicant will be stored either on paper records or a computer
system in accordance with the Data Protection Act 2018 and will be processed solely in connection with recruitment.
            </div>
           

        </form>

    </section>
</main>



<?php
    require_once('footer.inc.php');
?>