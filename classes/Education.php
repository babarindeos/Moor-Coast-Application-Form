<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class Education
{
    private $conn;
    private $table_name = "educational_qualifications";


    /// class properties
    public $id;
    public $user_id;
    public $institution;
    public $from_date;
    public $to_date;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function user_records()
    {
        try
        {
            $query = "Select * from ".$this->table_name." where user_id=:user_id";

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags($this->user_id));

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
                            user_id=:user_id, institution=:institution, from_date=:from_date, to_date=:to_date";
                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":institution", $this->institution);
                $stmt->bindParam(":from_date", $this->from_date);
                $stmt->bindParam(":to_date", $this->to_date);
                
                

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