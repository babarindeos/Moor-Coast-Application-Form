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
  include_once('classes/UserCategory.php');
  include_once('classes/RegistrationCompletion.php');

  $database = new Database();
  $db = $database->getConnection();

  
  $registration = new RegistrationCompletion($db);
  $registration->user_id = $_SESSION['user_id'];
  $registration_completion = $registration->registration_completed();

  
  if ($registration_completion)
  {
        header("location: registration_completed.php");
  }

  $category = new Category($db);
  $get_categories = $category->get_categories();

  

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
        $category_id = htmlspecialchars(strip_tags($_POST['category_id']));

        
        $user_category = new UserCategory($db);

        $user_category->user_id = $_SESSION['user_id'];


        $get_user_category = $user_category->get_user_category();



        if ($get_user_category)
        {
           
            $user_category->category_id =  $category_id;
            $user_category->user_id = $get_user_category['user_id'];

          
            $user_category->update();
            header("Location:section_c_participant_information.php");
        }
        else
        {
            $user_category->user_id = $_SESSION['user_id'];
            $user_category->category_id = $category_id;
           
           
            $create = $user_category->create();
            if ($create)
            {
                header("Location:section_c_participant_information.php");
            }
            else
            {
               
                header("Location:section_c_information.php");
            }
        }
       

  }
  


  // get user_category
  $user_category = new UserCategory($db);
  $user_category->user_id = $_SESSION['user_id'];

  $get_user_category = $user_category->get_user_category();

  //var_dump($get_user_category);

  require_once('nav.inc.php');
 
?>

<main class="bg-gray-100 min-h-screen">
    <?php
        require_once('menu.inc.php');
    ?>



    <section class="mx-5 md:mx-80 border-0 py-8 px-5 bg-white">
        <div class="text-2xl md:text-3xl text-green-800 font-semibold border-b py-2 border-gray-300">
            Conference Registration
        </div>
        <div class="flex flex-col md:flex-row md:justify-between border-0 md:items-center">
            <div class="text-lg md:text-xl text-black-500 font-semibold py-4 border-gray-300">
                Participation Category
            </div>
            <div class="flex flex-row justify-between border-0 gap-x-5">
                    <div>Section 2 of 6</div>
                    <div><a class='underline' href='section_a_participant_identification.php'>Previous</a> <?php if ($get_user_category){ echo "|  "."<a class='underline' href='section_c_participant_information.php'>Next</a>"; } ?>  </div> 
                    
            </div>
        </div>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="md:px-10 py-5">
            <div class="py-3">
                <label class='text-gray-500 font-medium text-sm'>Email</label>
                <div>
                        <div type="text"  class="border py-3 px-3 text-lg rounded-md text-gray-700 bg-gray-50" style="width:100%;" >
                                <?php 
                                    echo $_SESSION['user_email'];
                                ?>
                        </div>
                </div>
            </div>

            <div class="py-3">
                <label class='text-gray-500 font-medium text-sm'>Participation Category <sup class='text-red-600'>*</sup></label>
                <div>
                        <select name="category_id" required class="border py-3 px-3 text-lg rounded-md" style="width:100%;" />
                            <option value=''>-- Select Category --</option>
                            <?php
                                while ($row = $get_categories->fetch(PDO::FETCH_ASSOC))
                                {
                                    $selected = '';
                                    if ($row['category_id'] == $get_user_category['category_id'])
                                    {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='".$row['category_id']."' {$selected} >{$row['name']}</option>";
                                }
                            ?>
                        </select>
                </div>
            </div>


            <div class="py-3">
                
                <div>
                        <button type="submit" class="border py-4 rounded-md bg-gray-600 text-white 
                                                     font-semibold hover:bg-green-600 cursor-pointer" 
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