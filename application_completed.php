<?php

  session_start();
  session_destroy();

   require_once('nav.inc.php');
 ?>
<main class="bg-gray-100 min-h-screen ">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center border-b">
            <div>
                <div class="text-xl md:text-xl text-green-800 py-1 font-semibold border-gray-300">
                    Job Application
                </div>
                         
            </div>
            
        </div>

        
        <!-- Title of post applied for //-->           
        <div class='flex flex-col text-sm py-8 md:py-16 items-center justify-center border-0 font-semibold'>
            <div class='text-2xl'>Your application has been successfully submitted.</div>
            <div class='text-2xl'>Thank you for your time.</div>
        </div>
       
        
        
    </section>
</main>



<?php
    require_once('footer.inc.php');
?>