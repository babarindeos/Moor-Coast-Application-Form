<?php
    

    include_once("page_config.inc.php");


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $name = htmlspecialchars(strip_tags((string) $_POST['name']));
        $date = htmlspecialchars(strip_tags((string) $_POST['date']));
       
        

        //echo $other_activities;        
        
        $declaration = new Declaration($db);

        
        $declaration->user_id = $_SESSION['user_id'];

        $declaration->name = $name;
        $declaration->date = $date;
              

        $record_exist = $declaration->exists();
        
        if ($record_exist->rowCount() > 0)
        {
                $update =  $declaration->update($db);

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
             $create =  $declaration->create($db);   
             
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

        $declaration = new Declaration($db);
        $declaration->user_id = $_SESSION['user_id'];
        
        $declaration = $declaration->exists();
        $declaration = $declaration->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white mb-8">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    DECLARATION
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 12 of 13</div>
                <div>
                    <a href='section_k_consent.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <?php
                        if ($declaration){
                    ?>                     
                    <a href='section_m_consent_form.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
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
                You must provide the details of your current and or most recent employers. Please note that we can only accept one reference from one place of work.
                <br/><br/>
                If work references are not available then please provide details of character reference(s). Please note that these need to be someone who knows you well, isn’t currently working with
                you and is not a family relative.
                <br/><br/>
                Please at all times provide as much information as possible; this helps a faster and smoother recruitment process.
            </div>

            

            


             <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- former surnames //-->                

                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Name <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="name" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if ($declaration){ echo $declaration['name']; } ?>"
                                                                                />
                    </div>
                </div>

                 <div class="py-3 md:w-2/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'>*</sup></label>
                    <div class='py-1'>
                            <input type="text" name="date" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php if ($declaration){ echo $declaration['date']; } ?>"
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
                You must provide the details of your current and or most recent employers. Please note that we can only accept one reference from one place of work.
                <br/><br/>
                If work references are not available then please provide details of character reference(s). Please note that these need to be someone who knows you well, isn’t currently working with
                you and is not a family relative.
                <br/><br/>
                Please at all times provide as much information as possible; this helps a faster and smoother recruitment process.
            </div>
           

        </form>

    </section>
</main>



<?php
    require_once('footer.inc.php');
?>