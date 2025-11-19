<?php

   
  $status = "";
  $error_msg = "";

  include_once('config/database.php');
  include_once('classes/RegistrationCompletion.php');
  
  

  $database = new Database();
  $db = $database->getConnection();

  include_once('classes/Category.php');
  include_once('classes/Payment.php');
  include_once('classes/UserCategory.php');
  include_once('classes/Participant.php');
  include_once('classes/Paper.php');
  


  
  $participant = new Participant($db);
  $get_participants = $participant->get_all_participants();
  
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
                    <div class='border-b w-full py-2 border-gray-200'>
                        <label class="text-green-700 font-medium text-lg ">Participants Information</label>
                    </div>
                    <div class="flex flex-col gap-5 py-5">
                           <div>
                                    
                                    <table width="100%">
                                        <tr class="py-2 border-b">
                                           
                                            <td width="40%"><strong>Full name</strong></td>
                                            <td width="35%"><strong>Email</strong></td>
                                            <td width="25%"><strong>Phone</strong></td>
                                            

                                        </tr>
                                        <tbody>
                                            <?php
                                                while($row = $get_participants->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    extract($row);
                                                    echo "</tr>";
                                                    echo "<td class='py-3 border-b border-gray-300'>
                                                        <a href='registration_participant_registration_details.php?participant=".$user_id."&email=".$email."' class='underline text-blue-500'>{$prefix} {$firstname} {$lastname}</a></td>";
                                                    echo "<td class='py-3 border-b border-gray-300'>{$email}</td>";
                                                    echo "<td class='py-3 border-b border-gray-300'>{$phone}</td>";                                                    
                                                    echo "</tr>";
                                                }



                                            ?>
                                        
                                        </tbody>
                                    </table>

                                    

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