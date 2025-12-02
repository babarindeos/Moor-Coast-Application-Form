<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class InterviewReference
{
    private $conn;
    private $table_name = "applicant_references";


    /// class properties
    public $id;
    public $user_id; 
    public $title;   
    public $fullname;
    public $job_title;
    public $organisation;
    public $address;
    public $phone;
    public $email;
    public $fax;
    public $ref_prior_interview;
    
    

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



    public function readOne()
    {
        try
        {
            $query = "Select * from ".$this->table_name." where id=:id";

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags((string) $this->id));

            $stmt->bindParam(":id", $this->id);

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
                            user_id=:user_id, title=:title, fullname=:fullname, job_title=:job_title,
                            organisation=:organisation, address=:address, phone=:phone, email=:email, fax=:fax, 
                            ref_prior_interview=:ref_prior_interview";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":title", $this->title);
                $stmt->bindParam(":fullname", $this->fullname);
                $stmt->bindParam(":job_title", $this->job_title);
                $stmt->bindParam(":organisation", $this->organisation);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":phone", $this->phone);
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":fax", $this->fax);
                $stmt->bindParam(":ref_prior_interview", $this->ref_prior_interview);
                
                                            
                

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
                            title=:title, fullname=:fullname, job_title=:job_title,
                            organisation=:organisation, address=:address, phone=:phone, email=:email, fax=:fax,
                            ref_prior_interview=:ref_prior_interview where id=:id";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":id", $this->id);
                $stmt->bindParam(":title", $this->title);
                $stmt->bindParam(":fullname", $this->fullname);
                $stmt->bindParam(":job_title", $this->job_title);
                $stmt->bindParam(":organisation", $this->organisation);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":phone", $this->phone);
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":fax", $this->fax);
                $stmt->bindParam(":ref_prior_interview", $this->ref_prior_interview);
                             

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