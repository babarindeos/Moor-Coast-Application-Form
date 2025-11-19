<?php

  session_start();
  session_destroy();

  
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
                
            </div>
            
        </div>

        <div class='px-10'>
            <div class="py-3">
                    <label class="text-green-700 font-medium text-xl">CSA 2025 Registration Completed</label>
                    <div class="flex flex-col gap-5 py-5">
                           <div class='text-lg'>
                                   You have successfully completed and submitted your registration for the CSA 2025 Conference. <br/>Thank you for taking
                                   the time to register to be part of this conference.
                           </div>
                    </div>
            </div>
        </div>


        

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