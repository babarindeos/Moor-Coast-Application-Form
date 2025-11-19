<?php

  session_start();
  if (!isset($_SESSION['login']) || $_SESSION['login'] != 'csa2025')
  {
     header("Location: section_a_participant_identification.php");
  }


  $status = "";
  $error_msg = "";

  include_once('config/database.php');
  include_once('classes/Category.php');
  include_once('classes/Paper.php');

  $database = new Database();
  $db = $database->getConnection();

  $paper = new Paper($db);
  $paper->user_id = $_SESSION['user_id'];
  $get_paper = $paper->get_paper();

  //var_dump($get_paper);

  

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {

        $title = htmlspecialchars(strip_tags((string)$_POST['title']));
        $type = htmlspecialchars(strip_tags((string)$_POST['type']));
        $abstract = htmlspecialchars(strip_tags((string)$_POST['abstract']));       
        $keywords = htmlspecialchars(strip_tags((string)$_POST['keywords']));
        $co_authors = htmlspecialchars(strip_tags((string)$_POST['co_authors']));
        $file = $_FILES['file'];

        
        $get_paper = $paper->get_paper();
        $paper->title = $title;
        $paper->type = $type;
        $paper->abstract = $abstract;
        $paper->co_authors = $co_authors;
        $paper->keywords = $keywords;
        $paper->file = $file;
        
        
        if ($get_paper)
        {
            $paper->user_id = $_SESSION['user_id'];
            $update = $paper->update();
            header("location:section_e_payment.php");
        }
        else
        {
            $create = $paper->create();
             header("location:section_e_payment.php");
        }
        


  }


  require_once('nav.inc.php');
?>

<main class="bg-gray-100 min-h-screen">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 bg-white px-5">
        <div class="text-2xl md:text-3xl text-green-800 font-semibold border-b py-2 border-gray-300">
            Conference Registration
        </div>
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center">
            <div class="text-lg md:text-xl text-black-500 font-semibold py-4 border-gray-300">
                Paper Information
            </div>
            <div class="flex flex-row justify-between border-0 gap-x-5">
                    <div>Section 4 of 6</div>
                    <div><a class='underline' href='section_c_participant_information.php'>Previous</a>  |  <a class='underline' href='section_e_payment.php'>Next</a>  </div> 
                    
            </div>
        </div>

        <div class='px-10'>
            <div class="py-3">
                    <label class="text-gray-500 font-medium text-lg">Are you submitting an abstract for presentation?</label>
                    <div class="flex flex-row gap-5 py-5">
                            <input type="radio" name="presenting" id="presenting" class="border py-5 px-3 text-lg rounded-md"  
                                value="Yes" /> Yes

                            <input type="radio" name="presenting"  class="border py-3 px-3 text-lg rounded-md" style="" 
                                value="No" /> No
                    </div>
            </div>
        </div>



        <form action="<?php $_SERVER['PHP_SELF']; ?>" id="presentationForm" method="POST" enctype="multipart/form-data" class="md:px-10 py-5 hidden">
            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Paper Title</label>
                <div>
                        <input type="text" name="title" class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                            value="<?php  if($get_paper){ echo $get_paper['title']; }   ?>" />
                </div>
            </div>

            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Type of Presentation</label>
                <div>
                        <select type="text" name="type" class="border py-3 px-3 text-lg rounded-md" style="width:100%;">
                           
                            <option value='' >--Select Type of Presentation</option>
                            <option value='oral' <?php if ($get_paper && $get_paper['type']=='oral'){ echo 'selected'; } ?> >Oral/Poster Presentation</option>
                            <option value='virtual' <?php if ($get_paper && $get_paper['type']=='virtual'){ echo 'selected'; } ?> >Virtual Presentation</option>
                        </select>
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm items-start justify-start text-start">Abstract</label>
                <div>
                        <textarea cols="100" rows="10" name="abstract" class="border py-3 px-3 text-lg rounded-md" style="width:100%;"><?php if ($get_paper && $get_paper['abstract']!=''){ echo $get_paper['abstract']; } ?></textarea> 
                </div>
            </div>



            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Co-Authors Names</label>
                <div>
                        <input type="text" name="co_authors" class="border py-3 px-3 text-lg rounded-md" style="width:100%;"
                         value="<?php  if($get_paper){ echo $get_paper['co_authors']; }   ?>" />
                </div>
            </div>



            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Keywords</label>
                <div>
                        <input type="text" name="keywords" class="border py-3 px-3 text-lg rounded-md" style="width:100%;"
                         value="<?php  if($get_paper){ echo $get_paper['keywords']; }   ?>" />
                </div>
            </div>


            <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">File</label>
                <div>
                        <input type="file" name="file" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_paper){ echo $get_paper['file']; }   ?>" accept=".doc,.docx,.pdf" />
                </div>
                <?php if (!empty($get_paper['file'])): ?>
                    <p class="mt-2 text-sm text-gray-600 ">
                        Uploaded Paper:     
                        <a href="classes/uploads/papers/<?php echo htmlspecialchars($get_paper['file']); ?>" target="_blank" class="text-blue-600 underline">
                            <?php echo $get_paper['title']; ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>


             <div class="py-3">
                <label class="text-gray-500 font-medium text-sm">Terms of Agreement</label>
                <div>
                        <input type="checkbox" checked name="terms" disabled class="border py-3 px-3 text-lg rounded-md " style="" 
                        value="<?php  if($get_paper){ echo $get_paper['file']; }   ?>" accept=".doc,.docx,.pdf" />
                        I accept the terms of the following Copyright Agreement, and on submitting an abstract for possible publication to the ICCSA 2025. 
                        This copyright agreement prevails and is binding to the contributing author(s): All authors retain full copyright of their articles. 
                        The research works published in the Conference Proceedings are meeting the Open Access Publishing requirements and can be freely accessed, shared, modified, distributed and used in educational, commercial and non-commercial purposes under a Creative Commons Attribution 4.0 International License (CC BY 4.0). Authors grant the Conference a license to publish their article and be identified as the original publisher.
                </div>
            </div>

            

            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white font-semibold hover:bg-green-600 cursor-pointer" 
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    $('input[name="presenting"]').on('change', function(){
        if ($(this).val() === 'Yes') {
            $('#presentationForm').slideDown(); // show form smoothly
        } else {
            $('#presentationForm').slideUp(); // hide form smoothly
        }
    });
});
</script>