<?php

  session_start();
  //echo $_SESSION['user_id'];
  if (!isset($_SESSION['login']) || $_SESSION['login'] != 'csa2025')
  {
     header("Location: section_a_participant_identification.php");
  }
  
  $status = "";
  $error_msg = "";

  include_once('config/database.php');
  include_once('classes/RegistrationCompletion.php');
  
  

  $database = new Database();
  $db = $database->getConnection();


  
  $registration = new RegistrationCompletion($db);
  $registration->user_id = $_SESSION['user_id'];
  $registration_completion = $registration->registration_completed();

  //var_dump($registration_completion);
  //exit;
  if ($registration_completion)
  {
        header("location: registration_completed.php");
  }



  include_once('classes/Category.php');
  include_once('classes/Payment.php');
  include_once('classes/UserCategory.php');
  include_once('classes/Participant.php');
  include_once('classes/Paper.php');
  


  $payment = new Payment($db);
  $payment->user_id = $_SESSION['user_id'];
  $get_payment = $payment->get_payment();

  $user_category = new UserCategory($db);
  $user_category->user_id = $_SESSION['user_id'];
  $get_user_category = $user_category->get_user_category();

  $participant = new Participant($db);
  $participant->user_id = $_SESSION['user_id'];
  $get_participant = $participant->get_participant();

  $paper = new Paper($db);
  $paper->user_id = $_SESSION['user_id'];
  $get_paper = $paper->get_paper();


  //var_dump($get_payment);
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
               
       
            $registration->user_id = $_SESSION['user_id'];
            $create = $registration->create();

            if ($create)
            {
                header("Location: registration_completed.php");
            }
        
        


  }


  $get_payment = $payment->get_payment();

  require_once('nav.inc.php');
?>

<main class="bg-gray-100">
    <?php
        require_once('menu.inc.php');
    ?>


    <section class="mx-5 md:mx-80 border-0 py-8 bg-white px-5">
        <div class="text-2xl md:text-3xl text-green-800 font-semibold border-b py-2 border-gray-300">
            Conference Registration
        </div>
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center">
            <div class="text-lg md:text-xl text-black-500 font-semibold py-4 border-gray-300">
                Preview
            </div>
            <div class="flex flex-row justify-between border-0 gap-x-5">
                    <div>Section 6 of 6</div>
                    <div><a class='underline' href='section_e_payment.php'>Previous</a></div> 
                    
            </div>
        </div>

        <div class='px-10'>
            <div class="py-3">
                    <div class='border-b w-full py-2 border-gray-200'>
                        <label class="text-green-700 font-medium text-lg">Participation Category</label>
                    </div>
                    <div class="flex flex-col gap-5 py-5">
                           <div>
                                    <?php
                                            echo $get_user_category['name'];
                                    ?>
                           </div>
                    </div>
            </div>
        </div>


        <div class='px-10'>
            <div class="py-3">
                    <div class='border-b w-full py-2 border-gray-200'>
                        <label class="text-green-700 font-medium text-lg ">Participant Information</label>
                    </div>
                    <div class="flex flex-col gap-5 py-5">
                           <div>
                                    
                                    <table>
                                        <tr>                                 
                                            <td><strong>Full names:</strong></td>
                                            <td class='px-5 py-2'>
                                                <?php echo $get_participant['prefix'].' '.$get_participant['lastname'].' '.$get_participant['firstname'] ?>
                                            </td>
                                        </tr>
                                        <tr>                                 
                                            <td><strong>Phone:</strong></td>
                                            <td class='px-5 py-2'>
                                                <?php echo $get_participant['phone']; ?>
                                            </td>
                                        </tr>

                                        <tr>                                 
                                            <td><strong>Email:</strong></td>
                                            <td class='px-5 py-2'>
                                                <?php echo $_SESSION['user_email']; ?>
                                            </td>
                                        </tr>

                                        <tr>                                 
                                            <td><strong>Institution:</strong></td>
                                            <td class='px-5 py-2'>
                                                <?php echo $get_participant['institution']; ?>
                                            </td>
                                        </tr>

                                        <tr>                                 
                                            <td><strong>Country:</strong></td>
                                            <td class='px-5 py-2'>
                                                <?php echo $get_participant['country']; ?>
                                            </td>
                                        </tr>
                                    </table>

                                    

                           </div>
                    </div>
            </div>
        </div>


        <?php
         if ($get_paper)
         {
        ?>
         
                <div class='px-10'>
                    <div class="py-3">
                            <div class='border-b w-full py-2 border-gray-200'>
                                <label class="text-green-700 font-medium text-lg">Paper Information</label>
                            </div>
                            <div class="flex flex-col gap-5 py-5">
                                <div>
                                            
                                            <table>
                                                <tr>                                 
                                                    <td><strong>Paper Title:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo $get_paper['title']; ?>
                                                    </td>
                                                </tr>
                                                <tr>                                 
                                                    <td><strong>Presentation Type:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo ucwords($get_paper['type'])." Presentation"; ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Abstract:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo nl2br($get_paper['abstract']); ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Co-Author Names:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo $get_paper['co_authors']; ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Keywords:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo $get_paper['keywords']; ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Paper:</strong></td>
                                                    <td class='px-5 py-2'>
                                                       <?php if (!empty($get_paper['file'])): ?>
                                                            <p class="mt-2 text-sm text-gray-600">
                                                                <a href="classes/uploads/papers/<?php echo htmlspecialchars($get_paper['file']); ?>" target="_blank" class="text-blue-600 underline">
                                                                  <?php echo $get_paper['title']; ?>
                                                                </a>
                                                            </p>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            </table>

                                            

                                </div>
                            </div>
                    </div>
                </div>
        <?php
            }
        ?>


        <?php
         if ($get_payment)
         {
        ?>
        <div class='px-10'>
            <div class="py-3">
                    <div class='border-b w-full py-2 border-gray-200'>
                        <label class="text-green-700 font-medium text-lg">Payment</label>
                    </div>
                    <div class="flex flex-col gap-5 py-5">
                           <div>

                                    <table>
                                                <tr>                                 
                                                    <td><strong>Participation Category:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo ucwords($get_payment['category']); ?>
                                                    </td>
                                                </tr>
                                                <tr>                                 
                                                    <td><strong>Payer:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo $get_payment['payer']; ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Amount:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <?php echo nl2br($get_payment['amount']); ?>
                                                    </td>
                                                </tr>

                                                <tr>                                 
                                                    <td><strong>Receipt:</strong></td>
                                                    <td class='px-5 py-2'>
                                                        <a href="classes/uploads/receipts/<?php echo htmlspecialchars($get_payment['receipt']); ?>" target="_blank" class="text-blue-600 underline">
                                                            Payment Receipt
                                                        </a>
                                                    </td>
                                                </tr>
                                    </table>

                           </div>
                    </div>
            </div>
        </div>
        <?php
         }
        ?>



        <form action="<?php $_SERVER['PHP_SELF'] ?>" id="presentationForm" method="POST" enctype="multipart/form-data" class="md:px-10 py-5">

            
            

            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-green-600 text-white font-semibold hover:bg-green-500 cursor-pointer" 
                                style="width:100%;" >
                                FINAL SUBMISSION
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