<?php
 
   include_once('page_config.inc.php');

  if (!isset($_GET['u']) && $_GET['u'] != '')
  {
        if ($_GET['u'] != $_SESSION['user_id'])
        {
            header("location: index.php");
        }
  }

 


  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $user_id = $_SESSION['user_id'];
        $employer = htmlspecialchars(strip_tags($_POST['employer']));
        $post = htmlspecialchars(strip_tags($_POST['post']));
        $from_date = htmlspecialchars(strip_tags($_POST['from_date']));
        $to_date = htmlspecialchars(strip_tags($_POST['to_date']));
        $leaving_reason = htmlspecialchars(strip_tags($_POST['leaving_reason']));
        $final_grade = htmlspecialchars(strip_tags($_POST['final_grade']));
        $duties = htmlspecialchars(strip_tags($_POST['duties']));
       

        $previous_employment = new PreviousEmployment($db);
        $previous_employment->id = $_GET['q'];
        $previous_employment->user_id = $user_id;
        $previous_employment->employer = $employer;
        $previous_employment->post = $post;
        $previous_employment->from_date = $from_date;
        $previous_employment->to_date = $to_date;
        $previous_employment->leaving_reason = $leaving_reason;
        $previous_employment->final_grade = $final_grade;
        $previous_employment->duties = $duties;


        $create = $previous_employment->update();

        header("location:section_d_previous_employment.php");
        
  }





  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');


        $previous_employment = new PreviousEmployment($db);
        $previous_employment->user_id = $_SESSION['user_id'];
        $previous_employment = $previous_employment->edit($_SESSION['user_id'], $_GET['q']);
        $previous_employment = $previous_employment->fetch(PDO::FETCH_ASSOC);

        $previous_employments = new PreviousEmployment($db);
        $previous_employments->user_id = $_SESSION['user_id'];
        $previous_employments = $previous_employments->exists();
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 font-semibold  py-1 border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    PREVIOUS EMPLOYMENT
                </div>
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 4 of 13</div>
                <div>
                    <a href='section_c_present_post.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_e_driving_license.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>

            
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


             <?php
                    include_once('alert_message.inc.php');
             ?>
            
            
            

            <!-- Name and Address of Employers //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4 mt-3">
                <div class="py-3 md:w-2/6">
                    <label class='text-gray-800 font-medium text-sm'>Name and Address of Employers: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="employer" required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"><?php echo $previous_employment['employer']; ?></textarea>
                    </div>
                </div>

                <div class="py-3 md:w-2/6">
                    <label class='text-gray-800 font-medium text-sm'>Post held: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="post" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" 
                                                                                value="<?php echo $previous_employment['post'];  ?>" />
                    </div>
                </div>

                <div class="py-3 md:w-1/6">
                    <label class='text-gray-800 font-medium text-sm'>From: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="from_date" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php echo $previous_employment['from_date'];  ?>" />
                    </div>
                </div>


                <div class="py-3 md:w-1/6">
                    <label class='text-gray-800 font-medium text-sm'>To: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="to_date" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"
                                                                                value="<?php echo $previous_employment['to_date'];  ?>" />
                    </div>
                </div>
            </div>
            <!-- End of Name and Address of Employers //-->



            <!-- Reason for Leaving //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-2/3">
                    <label class='text-gray-800 font-medium text-sm'>Reason for Leaving: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="leaving_reason" required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" 
                                                                         value="<?php echo $previous_employment['leaving_reason'];  ?>" />
                    </div>
                </div>

                <div class="py-3 md:w-1/3">
                    <label class='text-gray-800 font-medium text-sm'>Final grade: <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="final_grade"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" 
                                                                                value="<?php echo $previous_employment['final_grade'];  ?>" />
                    </div>
                </div>
            </div>
            <!-- End of Reason for Leaving //-->           


            

            <!-- Description of duties //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-full">
                    <label class='text-gray-800 font-medium text-sm'>Description of duties: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="duties" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;"
                                                                          ><?php echo $previous_employment['duties'];  ?></textarea>
                    </div>
                </div>

                
            </div>
            <!-- End of Description of duties //-->



            

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
            if ($previous_employments->rowCount() > 0)
            {
        ?>
             <!-- section //-->
            <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
                    <!-- Education records in table //-->
                    <div class="py-1 p-6 mb-16" >
                                    <div class='text-lg font-semibold py-3'>Submitted Previous Employments (<?php echo $previous_employments->rowCount(); ?>) </div>
                                    
                                                           <?php
                                                                $counter = 0;
                                                            

                                                            while($row = $previous_employments->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                extract($row);
                                                            ?>
                                                            <!-- Name and Address of Employers //-->
                                                            <div class="mt-8 flex flex-row justify-end w-full border-0 gap-1">
                                                                <?php
                                                                     $code = bin2hex(random_bytes(40));
                                                                     $code2 = bin2hex(random_bytes(40));
                                                                     $code3 = bin2hex(random_bytes(40));
                                                                    $edit_link = "section_d_previous_employment_edit.php?en=".$code."&u=".$_SESSION['user_id']."&c=".$code2."&q=".$id."&d=".$code3;
                                                                    $delete_link =  "section_d_previous_employment_delete.php?en=".$code."&u=".$_SESSION['user_id']."&c=".$code2."&q=".$id."&d=".$code3;
                                                                ?>
                                                                <a href="<?php echo $edit_link; ?>" class="bg-green-700 text-white px-4 py-1 text-sm hover:bg-green-500 ">Edit</a> 
                                                                <a href="<?php echo $delete_link; ?>" class="bg-red-700 hover:bg-red-500 text-white px-4 py-1 text-sm">Delete</a>
                                                            </div>
                                                            <div class="border p-4 ">
                                                            
                                                                    <div class="flex flex-col md:flex-row w-full gap-x-4 mt-3">
                                                                        <div class="py-3 md:w-2/6">
                                                                            <label class='text-gray-800 font-medium text-sm'>Name and Address of Employers: <sup class='text-red-600'></sup></label>
                                                                            <div class="py-1">
                                                                                    <textarea name="employer" readonly required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;"><?php echo $employer;  ?></textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="py-3 md:w-2/6">
                                                                            <label class='text-gray-800 font-medium text-sm'>Post held: <sup class='text-red-600'></sup></label>
                                                                            <div class='py-1'>
                                                                                    <input type="text" name="post" readonly required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" value="<?php echo $post; ?>" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="py-3 md:w-1/6">
                                                                            <label class='text-gray-800 font-medium text-sm'>From: <sup class='text-red-600'></sup></label>
                                                                            <div class='py-1'>
                                                                                    <input type="text" name="from_date" readonly required value="<?php echo $from_date; ?>" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                                                                            </div>
                                                                        </div>


                                                                        <div class="py-3 md:w-1/6">
                                                                            <label class='text-gray-800 font-medium text-sm'>To: <sup class='text-red-600'></sup></label>
                                                                            <div class='py-1'>
                                                                                    <input type="text" name="to_date" readonly value="<?php echo $to_date; ?>" required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End of Name and Address of Employers //-->


                                                                    <!-- Reason for Leaving //-->
                                                                    <div class="flex flex-col md:flex-row w-full gap-x-4">
                                                                        <div class="py-3 md:w-2/3">
                                                                            <label class='text-gray-800 font-medium text-sm'>Reason for Leaving: <sup class='text-red-600'></sup></label>
                                                                            <div class="py-1">
                                                                                    <input type="text" name="leaving_reason" readonly value="<?php echo $leaving_reason; ?>" required  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="py-3 md:w-1/3">
                                                                            <label class='text-gray-800 font-medium text-sm'>Final grade: <sup class='text-red-600'></sup></label>
                                                                            <div class='py-1'>
                                                                                    <input type="text" name="final_grade" readonly  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                        focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End of Reason for Leaving //-->           


                                                                    

                                                                    <!-- Description of duties //-->
                                                                    <div class="flex flex-col md:flex-row w-full gap-x-4">
                                                                        <div class="py-3 md:w-full">
                                                                            <label class='text-gray-800 font-medium text-sm'>Description of duties: <sup class='text-red-600'></sup></label>
                                                                            <div class="py-1">
                                                                                    <textarea name="duties" readonly required class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 h-24 md:h-30" style="width:100%;" ><?php echo $duties; ?></textarea>
                                                                            </div>
                                                                        </div>

                                                                        
                                                                    </div>
                                                                    <!-- End of Description of duties //-->

                                                            </div>
                                                            <?php
                                                            }
                                                           
                                                            ?>

                                             
                                    </div>
                    </div>
                <!-- end of Educational records in table //-->
            </section>
        <?php 
            }
        ?>
        






</main>



<?php
    require_once('footer.inc.php');
?>