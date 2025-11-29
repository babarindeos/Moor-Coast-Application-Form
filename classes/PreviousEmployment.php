<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class PreviousEmployment
{
    private $conn;
    private $table_name = "previous_employments";


    /// class properties
    public $id;
    public $user_id;
    public $employer;
    public $post;
    public $from_date;
    public $to_date;
    public $leaving_reason;
    public $final_grade;
    public $duties;
   
    

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


    
    public function edit($user_id, $record_id)
    {
        try
        {
            $query = "Select * from ".$this->table_name." where user_id=:user_id and id=:id";

            $stmt = $this->conn->prepare($query);

            $this->user_id = htmlspecialchars(strip_tags((string) $user_id));

            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":id", $record_id);

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
                            user_id=:user_id, employer=:employer,
                            post=:post, from_date=:from_date, to_date=:to_date,
                            leaving_reason=:leaving_reason, final_grade=:final_grade, duties=:duties";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":employer", $this->employer);
                $stmt->bindParam(":post", $this->post);
                $stmt->bindParam(":from_date", $this->from_date);
                $stmt->bindParam(":to_date", $this->to_date);
                $stmt->bindParam(":leaving_reason", $this->leaving_reason);
                $stmt->bindParam(":final_grade", $this->final_grade);
                $stmt->bindParam(":duties", $this->duties);                
                

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

       
        return $data;
    }


    public function update()
    {
        try
        {          
                
                $query = "Update ".$this->table_name." set 
                            employer=:employer,
                            post=:post, from_date=:from_date, to_date=:to_date,
                            leaving_reason=:leaving_reason, final_grade=:final_grade, duties=:duties where id=:id";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":id", $this->id);
                $stmt->bindParam(":employer", $this->employer);
                $stmt->bindParam(":post", $this->post);
                $stmt->bindParam(":from_date", $this->from_date);
                $stmt->bindParam(":to_date", $this->to_date);
                $stmt->bindParam(":leaving_reason", $this->leaving_reason);
                $stmt->bindParam(":final_grade", $this->final_grade);
                $stmt->bindParam(":duties", $this->duties);                
                

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