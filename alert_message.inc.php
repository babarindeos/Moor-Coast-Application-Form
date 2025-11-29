<?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST')
                    {
                         if ($status == 'fail')
                         {
                                echo "<div class='my-4 py-6 px-4 border border-red-200 bg-red-50 rounded-md'>{$error_msg}</div>";
                         }
                         else 
                         {
                                echo "<div class='my-4 py-6 px-4 border border-green-200 bg-green-50 rounded-md'>{$error_msg}</div>";
                         }
                    }                          
                   
            ?>