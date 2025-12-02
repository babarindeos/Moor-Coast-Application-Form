<?php

  include_once("page_config.inc.php");

  if (!isset($_GET['u']) && $_GET['u'] != '')
  {
        if ($_GET['u'] != $_SESSION['user_id'])
        {
            header("location: index.php");
        }
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $title = htmlspecialchars(strip_tags((string) $_POST['title']));
        $fullname = htmlspecialchars(strip_tags((string) $_POST['fullname']));
        $job_title = htmlspecialchars(strip_tags((string) $_POST['job_title']));
        $organisation = htmlspecialchars(strip_tags((string) $_POST['organisation']));
        $address = htmlspecialchars(strip_tags((string) $_POST['address']));
        $phone = htmlspecialchars(strip_tags((string) $_POST['phone']));
        $email = htmlspecialchars(strip_tags((string) $_POST['email']));
        $fax = htmlspecialchars(strip_tags((string) $_POST['fax']));
        $reference_interview = htmlspecialchars(strip_tags((string) $_POST['reference']));

               
        

        //echo $other_activities;        
        
        $reference = new InterviewReference($db);

        
        $reference->id = $_GET['q'];
        $reference->user_id = $_SESSION['user_id'];


        echo $reference->id;
        

        $reference->title = $title;
        $reference->fullname = $fullname;
        $reference->job_title = $job_title;
        $reference->organisation = $organisation;
        $reference->address = $address;
        $reference->phone = $phone;
        $reference->email = $email;
        $reference->fax = $fax;
        $reference->ref_prior_interview = $reference_interview;
              

        
        $update =  $reference->update($db);   
        
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





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');

        
        $reference = new InterviewReference($db);
        $reference->user_id = $_SESSION['user_id'];
        $reference->id = $_GET['q'];
        $reference_records = $reference->readOne();
        $reference_records = $reference_records->fetch(PDO::FETCH_ASSOC);
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    REFERENCES
                </div>               
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 10 of 13</div>
                <div>
                    <a href='section_i_rehabilitation_offenders_act.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_k_consent.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
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
                You must provide the details of your current and or most recent employers. Please note that we can only accept one reference from one place of work.
                <br/><br/>
                If work references are not available then please provide details of character reference(s). Please note that these need to be someone who knows you well, isn’t currently working with
                you and is not a family relative.
                <br/><br/>
                Please at all times provide as much information as possible; this helps a faster and smoother recruitment process.
            </div>

            

            


            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Title (Mr, Mrs etc):  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="title" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                         value="<?php if ( $reference_records){ echo $reference_records['title']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->



            <!-- Do you have regular access to a car? //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Full Name:  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="fullname" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                         value="<?php if ( $reference_records){ echo $reference_records['fullname']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Do you have regular access to a car? //-->



            <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                           Job Title:  <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="job_title" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full" 
                                                                         value="<?php if ( $reference_records){ echo $reference_records['job_title']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->



            <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                          Organisation:   <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="organisation" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full" 
                                                                         value="<?php if ( $reference_records){ echo $reference_records['organisation']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->


            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Address <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="address" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if ( $reference_records){ echo $reference_records['address']; } ?></textarea>
                    </div>
                </div>

                
            </div>
            <!-- End of Description of duties //-->



            <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400 border-t">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                          Tel No:    <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="phone" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                         value="<?php if ( $reference_records){ echo $reference_records['phone']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->



            <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                          E-mail address:    <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="email" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                         value="<?php if ( $reference_records){ echo $reference_records['email']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->


            <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                          Fax No:    <sup class='text-red-600'></sup>
                    </div>
                </div>

                <div class="py-3 md:w-4/5">
                    
                    <div class="flex py-1 border-0">
                                <input type="text" name="fax"  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full" 
                                                                         value="<?php if ( $reference_records){ echo $reference_records['fax']; } ?>"
                                                                         /> 

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->



             <!-- Job Title //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'></label>
                    <div class="py-1">
                          Please state if we may obtain this reference prior to interview.    <sup class='text-red-600'>*</sup>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    
                    <div class="flex py-1 border-0">
                                 <input type="radio" name="reference" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                                         <?php if ( $reference_records && $reference_records['ref_prior_interview']=="1"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> Yes </span>

                                <input type="radio" name="reference" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3" 
                                                                         <?php if ( $reference_records && $reference_records['ref_prior_interview']=="0"){ echo "checked"; } ?>
                                                                         /> <span class="text-md border-0 px-2"> No </span>

                                
                            
                    </div>
                </div>

                
            </div>
            <!-- End of Job Title //-->


            

            

            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
                                style="width:100%;" >
                                Update
                        </button>
                </div>
            </div>

           

        </form>

    </section>



    <?php 
            $reference = new InterviewReference($db);
            $reference->user_id = $_SESSION['user_id'];
            $reference_records = $reference->exists();


            if ($reference_records->rowCount() > 0)
            {
    ?>
    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
             <div class="py-1 p-6 mb-16" >
                    <div class='text-lg font-semibold py-3 border-b'>Submitted References (<?php echo $reference_records->rowCount(); ?>) </div>
                
                    <?php   
                        $counter = 0;


                    while($row = $reference_records->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);

                        ++$counter;
                    ?>
                     <!-- Name and Address of Employers //-->
                    <div class="mt-8 flex flex-row justify-between w-full border-0 gap-1">
                        <div class='py-0'>
                             <div class="bg-green-600 py-1 px-2 text-sm text-white">
                                Reference <?php echo $counter; ?>
                            </div>
                        </div>
                        <div>
                                <?php
                                        $code = bin2hex(random_bytes(40));
                                        $code2 = bin2hex(random_bytes(40));
                                        $code3 = bin2hex(random_bytes(40));
                                    $edit_link = "section_j_references_edit.php?en=".$code."&u=".$_SESSION['user_id']."&c=".$code2."&q=".$id."&d=".$code3;
                                    $delete_link =  "section_j_references_delete.php?en=".$code."&u=".$_SESSION['user_id']."&c=".$code2."&q=".$id."&d=".$code3;
                                ?>
                                <a href="<?php echo $edit_link; ?>" class="bg-blue-700 text-white px-4 py-1 text-sm hover:bg-blue-500 ">Edit</a> 
                                <a href="<?php echo $delete_link; ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-1 text-sm">Delete</a>
                        </div>
                       
                    </div>
                    <div class="border p-4 ">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">                                   


                                    <!-- Do you have regular access to a car? //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Title (Mr, Mrs etc):  <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="title" disabled required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $title; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Do you have regular access to a car? //-->



                                    <!-- Do you have regular access to a car? //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Full Name:  <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="fullname" required disabled  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $fullname; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Do you have regular access to a car? //-->



                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Job Title:  <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="job_title" disabled required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $job_title; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->



                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Organisation:   <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="organisation" disabled required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $organisation; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->


                                    <!-- Description of duties //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 mt-5">
                                        <div class="py-3 md:w-full">
                                            <label class='text-gray-800 font-medium text-sm'>Address <sup class='text-red-600'></sup></label>
                                            <div class="py-1">
                                                    <textarea name="address" required disabled class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php if ($reference_records){ echo $address; }  ?></textarea>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Description of duties //-->



                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400 border-t">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Tel No:    <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="phone" disabled required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full" 
                                                                                                value="<?php if ($reference_records){ echo $phone; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->



                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                E-mail address:    <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="email" disabled required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $email; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->


                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-1/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Fax No:    <sup class='text-red-600'></sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-4/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="text" name="fax" disabled  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-full"
                                                                                                value="<?php if ($reference_records){ echo $fax; }  ?>"
                                                                                                /> 

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->



                                    <!-- Job Title //-->
                                    <div class="flex flex-col md:flex-row w-full gap-x-4 border-b mt-4 border-gray-400">
                                        <div class="py-3 md:w-4/5">
                                            <label class='text-gray-800 font-medium text-sm'></label>
                                            <div class="py-1">
                                                Please state if we may obtain this reference prior to interview.    <sup class='text-red-600'>*</sup>
                                            </div>
                                        </div>

                                        <div class="py-3 md:w-1/5">
                                            
                                            <div class="flex py-1 border-0">
                                                        <input type="radio" disabled name="reference" value="1" required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6"
                                                                                                <?php if ($reference_records && $ref_prior_interview == '1'){ echo 'checked'; }  ?>
                                                                                                /> <span class="text-md border-0 px-2"> Yes </span>

                                                        <input type="radio" disabled name="reference" value="0" required  class="border py-3 rounded-md px-3 text-lg
                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 w-6 h-6 ml-3"
                                                                                                <?php if ($reference_records && $ref_prior_interview == '0'){ echo 'checked'; }  ?>
                                                                                                /> <span class="text-md border-0 px-2"> No </span>

                                                        
                                                    
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- End of Job Title //-->                         

                                

                                </form>
                    </div>
                 <?php
                    }

                ?>

            </div>

    </section>
    <?php

            }
    ?>


</main>



<?php
    require_once('footer.inc.php');
?>