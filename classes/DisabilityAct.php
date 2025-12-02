<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class DisabilityAct
{
    private $conn;
    private $table_name = "disability_act";


    /// class properties
    public $id;
    public $user_id;    
    public $disabled;
    public $overcome_disability;
    public $further_details;
    public $interview_assistance;
    public $required_assistance;  
    

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function exists()
    {
        try
        {
            $query = "Select * from ".$this->table_name." where user_id=:user_id";

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags((string) $this->user_id));

            $stmt->bindParam(":user_id", $this->user_id);

            $stmt->execute();            

        }
        catch(Exception $e)
        {
            $stmt = null;
        }

        return $stmt;
    }


    
    


    public function create()
    {
        try
        {          
                
                $query = "Insert into ".$this->table_name." set 
                            user_id=:user_id, disabled=:disabled, overcome_disability=:overcome_disability,
                            further_details=:further_details, interview_assistance=:interview_assistance, 
                            required_assistance=:required_assistance";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":disabled", $this->disabled);
                $stmt->bindParam(":overcome_disability", $this->overcome_disability);
                $stmt->bindParam(":further_details", $this->further_details); 
                $stmt->bindParam(":interview_assistance", $this->interview_assistance);
                $stmt->bindParam(":required_assistance", $this->required_assistance);                             
                

                if ($stmt->execute())
                {
                    $data = [
                        'status' => 'success',
                        'message' => "The record has been successfully created"
                    ];
                    
                }
                else
                {
                    $data = [
                        'status' => 'fail',
                        'message' => "An error occurred creating the record."
                    ];

                }
        }
        catch(Exception $e)
        {
             $data = [
                'status'  => 'fail',
                'message' => 'Error: ' . $e->getMessage()
            ];
        }

       
        //var_dump($data);
        return $data;
    }


    public function update()
    {
        try
        {          
                
                $query = "Update ".$this->table_name." set 
                            disabled=:disabled, overcome_disability=:overcome_disability,
                            further_details=:further_details, interview_assistance=:interview_assistance, 
                            required_assistance=:required_assistance where user_id=:user_id";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":disabled", $this->disabled);
                $stmt->bindParam(":overcome_disability", $this->overcome_disability);
                $stmt->bindParam(":further_details", $this->further_details); 
                $stmt->bindParam(":interview_assistance", $this->interview_assistance);
                $stmt->bindParam(":required_assistance", $this->required_assistance);        
                             
                

                if ($stmt->execute())
                {
                    $data = [
                        'status' => 'success',
                        'message' => "The record has been successfully updated"
                    ];
                    
                }
                else
                {
                    $data = [
                        'status' => 'fail',
                        'message' => "An error occurred updating the record."
                    ];

                }
        }
        catch(Exception $e)
        {
             $data = [
                'status'  => 'fail',
                'message' => 'Error: ' . $e->getMessage()
            ];
        }

       
        //var_dump($data);
        return $data;
    }


    public function delete()
    {
        try
        {
            $query = "Delete from ".$this->table_name." where id=:id";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $this->id);

            $stmt->execute();

            

        }
        catch(Exception $e)
        {
            $stmt = null;
        }

        return $stmt;
    }


}


?>