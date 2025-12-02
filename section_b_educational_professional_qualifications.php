<?php
  include_once('page_config.inc.php');

  if (isset($_POST['btn_educational']))
  {
        $education = new Education($db);
        //echo $_SESSION['user_id'];

        $education->user_id = $_SESSION['user_id'];
        
        $education->institution = htmlspecialchars(strip_tags($_POST['institution']));
        $education->from_date = htmlspecialchars(strip_tags($_POST['from_date']));
        $education->to_date = htmlspecialchars(strip_tags($_POST['to_date']));

        $create = $education->create();
        if($create['status'])
        {
            $status = 'success';
            $error_msg = "The Educational Qualification has been successfully saved";
        }
        else
        {
            $status = "fail";
            $error_msg = "An error occurred saving the Education Qualification";
        }
  }


  if (isset($_POST['btn_education_delete']))
  {

  }


  if (isset($_POST['btn_professional']))
  {
        $professional = new Profession($db);
        //echo $_SESSION['user_id'];

        $professional->user_id = $_SESSION['user_id'];
        
        $professional->certificate = htmlspecialchars(strip_tags($_POST['certificate']));
        $professional->grade = htmlspecialchars(strip_tags($_POST['grade']));
        $professional->date_obtained = htmlspecialchars(strip_tags($_POST['date_obtained']));

        $create = $professional->create();

        if($create['status'])
        {
            $status = 'success';
            $error_msg = "The Professional Qualification has been successfully saved";
        }
        else
        {
            $status = "fail";
            $error_msg = "An error occurred saving the Professional Qualification";
        }
  }



  if (isset($_POST['btn_training_course']))
  {
        $training_course = new TrainingCourse($db);
        //echo $_SESSION['user_id'];

        $training_course->user_id = $_SESSION['user_id'];
        
        $training_course->course = htmlspecialchars(strip_tags($_POST['course']));
        $training_course->date_obtained = htmlspecialchars(strip_tags($_POST['date_obtained']));

        $create = $training_course->create();

        if($create['status'])
        {
            $status = 'success';
            $error_msg = "The Other Qualification has been successfully saved";
        }
        else
        {
            $status = "fail";
            $error_msg = "An error occurred saving the Other Qualification";
        }
  }




  require_once('nav.inc.php');

?>

<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');

        $education = new Education($db);
        $education->user_id = $_SESSION['user_id'];
        $educational_records = $education->user_records();



        $professional = new Profession($db);
        $professional->user_id = $_SESSION['user_id'];
        $professional_records = $professional->user_records();
        //echo $professional_records->rowCount();



        $training_course = new TrainingCourse($db);
        $training_course->user_id = $_SESSION['user_id'];
        $training_course_records = $training_course->user_records();
        
    

    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 font-semibold  py-1 border-gray-300">
                    Job Application Form
                </div>
                <div class="text-md md:text-md text-black-500 font-semibold border-gray-300">
                    EDUCATIONAL AND PROFESSIONAL QUALIFICATION
                </div>
            </div>
            <div class="flex flex-col md:flex-col gap-1 py-3 md:py-0">
                <div>Section 2 of 13</div>
                <div>
                    <a href='section_a_personal_details.php' class='py-1 rounded-l px-5 bg-white text-blue-600 
                                                                    text-sm border border-blue-500 hover:bg-blue-400 
                                                                    hover:border-blue-400
                                                                    hover:text-white'>Previous</a>
                    <a href='section_c_present_post.php' class='py-1 rounded-r px-5 bg-blue-500 text-white text-sm 
                                                                    border border-blue-500 hover:border-blue-400 hover:bg-blue-400'>Next</a>
                </div>
            </div>
        </div>

        

       
        
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">


             <?php
                    include_once('alert_message.inc.php');
             ?>
            
            
           

            

            <!-- EDUCATIONAL AND PROFESSIONAL QUALIFICATION //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Secondary School/ College/ University <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <input type="text" name="institution" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                         focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>From <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="from_date"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>To <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="to_date" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>
            </div>
            <!-- End of EDUCATIONAL AND PROFESSIONAL QUALIFICATION //-->

            <div class="py-3">
                
                <div>
                        <input  type="submit" name="btn_educational" class="border py-4 rounded-md bg-gray-600 text-white 
                                                    font-semibold hover:bg-green-600 cursor-pointer" 
                                                    style="width:100%;" value="Submit Educational Qualification" >
                                
                        
                </div>
            </div>

        </form>

        <?php 
            if ($educational_records->rowCount() > 0)
            {
        ?>

                    <!-- Education records in table //-->
                    <div class="py-1 border p-6 mb-16" >
                                    <div class='text-lg font-semibold py-3'>Submitted Educational Records (<?php echo $educational_records->rowCount(); ?>) </div>
                                    <div class="flex flex-col overflow-x-auto">
                                        <div class="sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                <div class="overflow-x-auto">
                                                        <table
                                                        class="min-w-full text-start text-md ">
                                                        <thead
                                                            class="border-b border-neutral-200 font-medium">
                                                            <tr>
                                                            <th scope="col" class="px-2 py-4">#</th>
                                                            <th scope="col" class="px-2 py-4 text-left border-0">Institution</th>
                                                            <th scope="col" class="px-2 py-4 text-left">From</th>                                                            
                                                            <th scope="col" class="px-2 py-4 text-left">To</th>
                                                            <th width='20%' scope="col" class="px-4 py-4 text-center">Action</th>
                                                        

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                                $counter = 0;
                                                            

                                                            while($row = $educational_records->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                extract($row);
                                                            ?>
                                                            <tr class="border-b">
                                                                <td class='text-center px-2 py-8'><?php echo ++$counter; ?>.</td>
                                                                <td class='px-2'><?php echo  $institution; ?></td>
                                                                <td class='px-2'><?php echo $from_date; ?></td>                                                                
                                                                <td class='px-2'><?php echo $to_date; ?></td>
                                                                <td class='px-4 border-0'>
                                                                        <div class='flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-1 justify-center items-center'>
                                                                            
                                                                            <div>
                                                                                <?php 
                                                                                    $code = bin2hex(random_bytes(40));
                                                                                    $code2 = bin2hex(random_bytes(40));
                                                                                    $code3 = bin2hex(random_bytes(40));
                                                                                    $edit_link = "section_b_educational_professional_qualifications_delete.php?sec=1&en=".$code."&u=".$_SESSION['user_id']."&m=".$code3."&q=".$id."&co=".$code2;
                                                                                ?>
                                                                                   
                                                                                    <a href="<?php echo $edit_link; ?>" class='text-sm border 
                                                                                            border-blue-400 
                                                                                            px-4 py-1 rounded-md hover:bg-blue-50 hover:cursor-pointer'>
                                                                                            <i class="fa-solid fa-trash-can text-red-600"></i></a>
                                                                                
                                                                            </div>

                                                                        </div>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                                    }
                                                           
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
        <?php 
            }
        ?>
        <!-- end of Educational records in table //-->





        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5 mt-16">            


            <!-- Professional Qualifications currently held how obtained, grade and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- former surnames //-->
                <div class="py-3 md:w-3/5">
                    <label class='text-gray-800 font-medium text-sm'>Professional Qualifications currently held how obtained: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="certificate" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            h-24 md:h-24" style="width:100%;" ></textarea>
                    </div>
                </div>

                <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Grade <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="grade"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="date_obtained" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>
            </div>
            <!-- End of Professional Qualifications currently held how obtained, grade and date  //-->


             <div class="py-3">
                
                <div>
                        <input type="submit" name="btn_professional" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
                                style="width:100%;"  value="Submit Professional Qualification"/>
                              
                </div>
            </div>

        </form>

        
        <?php 
            if ($professional_records->rowCount() > 0 )
            {
        ?>

                    <!-- Education records in table //-->
                    <div class="py-1 border p-6 mb-16" >
                                    <div class='text-lg font-semibold py-3'>Submitted Professional Records (<?php echo $professional_records->rowCount(); ?>) </div>
                                    <div class="flex flex-col overflow-x-auto">
                                        <div class="sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                <div class="overflow-x-auto">
                                                        <table
                                                        class="min-w-full text-start text-md ">
                                                        <thead
                                                            class="border-b border-neutral-200 font-medium">
                                                            <tr>
                                                                <th scope="col" class="px-2 py-4">#</th>
                                                                <th scope="col" class="px-2 py-4 text-left border-0">Certificate</th>
                                                                <th scope="col" class="px-2 py-4 text-left">Grade</th>                                                            
                                                                <th scope="col" class="px-2 py-4 text-left">Date</th>
                                                                <th width='20%' scope="col" class="px-4 py-4 text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                                $counter = 0;
                                                            

                                                            while($row = $professional_records->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                extract($row);
                                                            ?>
                                                            <tr class="border-b">
                                                                <td class='text-center px-2 py-8'><?php echo ++$counter; ?>.</td>
                                                                <td class='px-2'><?php echo  $certificate; ?></td>
                                                                <td class='px-2'><?php echo $grade; ?></td>                                                                
                                                                <td class='px-2'><?php echo $date_obtained; ?></td>
                                                                <td class='px-4 border-0'>
                                                                        <div class='flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-1 justify-center items-center'>
                                                                            
                                                                            <div>
                                                                                <?php 
                                                                                    $code = bin2hex(random_bytes(40));
                                                                                    $code2 = bin2hex(random_bytes(40));
                                                                                    $code3 = bin2hex(random_bytes(40));
                                                                                    $delete_link = "section_b_educational_professional_qualifications_delete.php?sec=2&en=".$code."&u=".$_SESSION['user_id']."&m=".$code3."&q=".$id."&co=".$code2;
                                                                                ?>
                                                                                   
                                                                                    <a href="<?php echo $delete_link; ?>" class='text-sm border 
                                                                                            border-blue-400 
                                                                                            px-4 py-1 rounded-md hover:bg-blue-50 hover:cursor-pointer'>
                                                                                            <i class="fa-solid fa-trash-can text-red-600"></i></a>
                                                                                
                                                                            </div>

                                                                        </div>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                                    }
                                                           
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
        <?php 
            }
        ?>
        <!-- end of Educational records in table //-->








            
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">
            

            <!-- Other relevant Educational or Training Courses and date  //-->
            <div class="flex flex-col md:flex-row w-full gap-x-4">
                <!-- Other relevant Educational or Training Courses //-->
                <div class="py-3 md:w-4/5">
                    <label class='text-gray-800 font-medium text-sm'>Other relevant Educational or Training Courses: <sup class='text-red-600'></sup></label>
                    <div class="py-1">
                            <textarea name="course"  class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                            focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400 
                                                                            h-24 md:h-24" style="width:100%;" ></textarea>
                    </div>
                </div>

                

                 <div class="py-3 md:w-1/5">
                    <label class='text-gray-800 font-medium text-sm'>Date <sup class='text-red-600'></sup></label>
                    <div class='py-1'>
                            <input type="text" name="date_obtained" class="border py-3 rounded-md px-3 text-lg shadow-md 
                                                                                focus:outline-none focus:ring-1 focus:ring-sky-300/50 focus:border-sky-400" style="width:100%;" />
                    </div>
                </div>
            </div>
            <!-- End of Other relevant Educational or Training Courses and date  //-->


             <div class="py-3">
                
                <div>
                        <input type="submit" name="btn_training_course" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
                                                     value="Submit Other Qualifications"
                                style="width:100%;" />
                                
                        
                </div>
            </div>           

           

        </form>

        <?php 
            if ($training_course_records->rowCount() > 0 )
            {
        ?>

                    <!-- Education records in table //-->
                    <div class="py-1 border p-6 mb-16" >
                                    <div class='text-lg font-semibold py-3'>Submitted Other Records (<?php echo $training_course_records->rowCount(); ?>) </div>
                                    <div class="flex flex-col overflow-x-auto">
                                        <div class="sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                <div class="overflow-x-auto">
                                                        <table
                                                        class="min-w-full text-start text-md ">
                                                        <thead
                                                            class="border-b border-neutral-200 font-medium">
                                                            <tr>
                                                                <th scope="col" class="px-2 py-4">#</th>
                                                                <th scope="col" class="px-2 py-4 text-left border-0">Course</th>                                                                                                                           
                                                                <th scope="col" class="px-2 py-4 text-left">Date</th>
                                                                <th width='20%' scope="col" class="px-4 py-4 text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           <?php
                                                                $counter = 0;
                                                            

                                                            while($row = $training_course_records->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                extract($row);
                                                            ?>
                                                            <tr class="border-b">
                                                                <td class='text-center px-2 py-8'><?php echo ++$counter; ?>.</td>
                                                                <td class='px-2'><?php echo  $course; ?></td>                                                              
                                                                <td class='px-2'><?php echo $date_obtained; ?></td>
                                                                <td class='px-4 border-0'>
                                                                        <div class='flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-1 justify-center items-center'>
                                                                            <div>
                                                                                <?php 
                                                                                    $code = bin2hex(random_bytes(40));
                                                                                    $code2 = bin2hex(random_bytes(40));
                                                                                    $code3 = bin2hex(random_bytes(40));
                                                                                    $delete_link = "section_b_educational_professional_qualifications_delete.php?sec=3&en=".$code."&u=".$_SESSION['user_id']."&m=".$code3."&q=".$id."&co=".$code2;
                                                                                ?>
                                                                                   
                                                                                    <a href="<?php echo $delete_link; ?>" class='text-sm border 
                                                                                            border-blue-400 
                                                                                            px-4 py-1 rounded-md hover:bg-blue-50 hover:cursor-pointer'>
                                                                                            <i class="fa-solid fa-trash-can text-red-600"></i></a>
                                                                                
                                                                            </div>

                                                                        </div>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                                    }
                                                           
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
        <?php 
            }
        ?>
        <!-- end of Educational records in table //-->












    </section>
</main>



<?php
    require_once('footer.inc.php');
?>