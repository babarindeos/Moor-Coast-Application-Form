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
  include_once('classes/Payment.php');

  $database = new Database();
  $db = $database->getConnection();

  $payment = new Payment($db);
  $payment->user_id = $_SESSION['user_id'];
  $get_payment = $payment->get_payment();

  //var_dump($get_payment);
  //exit;

  

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $category = htmlspecialchars(strip_tags((string)$_POST['category']));
        $payer = htmlspecialchars(strip_tags((string)$_POST['payer']));
        $amount = htmlspecialchars(strip_tags((string)$_POST['amount']));        
        $receipt = $_FILES['receipt'];

        
        $get_payment = $payment->get_payment();
        $payment->category = $category;
        $payment->payer = $payer;
        $payment->amount = $amount;
        $payment->receipt = $receipt;
        
        
        
        if ($get_payment)
        {
            $payment->user_id = $_SESSION['user_id'];
            $update = $payment->update();
            header("location:section_f_preview.php");
        }
        else
        {
            $create = $payment->create();
            header("location:section_f_preview.php");
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
                Payment
            </div>
            <div class="flex flex-row justify-between border-0 gap-x-5">
                    <div>Section 5 of 6</div>
                    <div><a class='underline' href='section_d_paper_information.php'>Previous</a> <?php if ($get_payment){ echo "|  "."<a class='underline' href='section_f_preview.php'>Next</a>"; } ?>  </div> 
                    
            </div>
        </div>

        <div class='px-10'>
            <div class="py-3">
                    <label class="text-green-700 font-medium text-lg">🇳🇬 For Local Participants (within Nigeria):</label>
                    <div class="flex flex-col gap-5 py-5">
                           <div>
                                    Make a payment of <strong>₦30,000 (Thirty Thousand Naira)</strong> to the account below:<br/>
                                    <br/>
                                    <strong>Account Name:</strong> FUNAAB INTEGRATED VENTURE
                                    <br/>
                                    <strong>Account Number:</strong> 1595608183
                                    <br/>
                                    <strong>Bank Name:</strong> Access Bank

                           </div>
                    </div>
            </div>
        </div>


        <div class='px-10'>
            <div class="py-3">
                    <label class="text-green-700 font-medium text-lg">For International Participants (Outside Nigeria):</label>
                    <div class="flex flex-col gap-5 py-5">
                           <div>
                                    Make <strong>75 USD ($)</strong> payment to the account below:<br/>
                                    <br/>
                                    <strong>Account Name:</strong> FUNAAB INTEGRATED VENTURE
                                    <br/>
                                    <strong>Account Number:</strong> 1955273646
                                    <br/>
                                    <strong>Bank Name:</strong> Access Bank

                           </div>
                    </div>
            </div>
        </div>



        <form action="<?php $_SERVER['PHP_SELF']; ?>" id="presentationForm" method="POST" enctype="multipart/form-data" class="md:px-10 py-5">

            <div class="py-3">
                <label class="text-gray-500 font-medium text-md">Participation Category</label>
                <div>
                        <select type="text" name="category" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_payment){ echo $get_payment['payer']; }   ?>" accept=".doc,.docx,.pdf" >
                                <option value=''>-- Select Participation Category --</option>
                                <option value='local' <?php  if($get_payment && $get_payment['category'] == 'local'){ echo 'selected'; }   ?> >Local Participation</option>
                                <option value='international' <?php  if($get_payment && $get_payment['category'] == 'international'){ echo 'selected'; }   ?> >International Participation</option>
                        </select>
                </div>
            </div>

            <div class="py-3">
                <label class="text-gray-500 font-medium text-md">Payer's Name</label>
                <div>
                        <input type="text" name="payer" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_payment){ echo $get_payment['payer']; }   ?>" accept=".doc,.docx,.pdf" />
                </div>
            </div>

            <div class="py-3">
                <label class="text-gray-500 font-medium text-md">Amount Paid</label>
                <div>
                        <input type="text" name="amount" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                        value="<?php  if($get_payment){ echo $get_payment['amount']; }   ?>" accept=".doc,.docx,.pdf" />
                </div>
            </div>

            <div class="py-3">
                <label class="text-gray-500 font-medium text-md">Upload Payment Receipt</label>
                <div>
                        <input type="file" name="receipt" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" 
                           accept=".doc,.docx,.pdf" />
                </div>
                <?php if (!empty($get_payment['receipt'])): ?>
                    <p class="mt-2 text-sm text-gray-600">
                        Uploaded Receipt: <a href="classes/uploads/receipts/<?php echo htmlspecialchars($get_payment['receipt']); ?>" target="_blank" class="text-blue-600 underline">
                           Payment Receipt
                        </a>
                    </p>
                <?php endif; ?>
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