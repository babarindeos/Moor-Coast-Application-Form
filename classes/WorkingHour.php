<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class WorkingHour
{
    private $conn;
    private $table_name = "working_hours";


    /// class properties
    public $id;
    public $user_id;
    public $work_hours;
    public $impromptu_work;
    public $start_date;
    public $employer_notice;
    public $other_work;
    public $future_holiday;
   
   
    

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
                            user_id=:user_id, work_hours=:work_hours,
                            impromptu_work=:impromptu_work, start_date=:start_date, employer_notice=:employer_notice,
                            other_work=:other_work, future_holiday=:future_holiday";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":work_hours", $this->work_hours);
                $stmt->bindParam(":impromptu_work", $this->impromptu_work);
                $stmt->bindParam(":start_date", $this->start_date);
                $stmt->bindParam(":employer_notice", $this->employer_notice);
                $stmt->bindParam(":other_work", $this->other_work);
                $stmt->bindParam(":future_holiday", $this->future_holiday);
                             
                

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
                            work_hours=:work_hours, impromptu_work=:impromptu_work, start_date=:start_date, 
                            employer_notice=:employer_notice, other_work=:other_work, future_holiday=:future_holiday 
                            where user_id=:user_id";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":work_hours", $this->work_hours);
                $stmt->bindParam(":impromptu_work", $this->impromptu_work);
                $stmt->bindParam(":start_date", $this->start_date);
                $stmt->bindParam(":employer_notice", $this->employer_notice);
                $stmt->bindParam(":other_work", $this->other_work);
                $stmt->bindParam(":future_holiday", $this->future_holiday);
                             
                

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