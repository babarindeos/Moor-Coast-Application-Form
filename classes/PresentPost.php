<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class PresentPost
{
    private $conn;
    private $table_name = "present_posts";


    /// class properties
    public $id;
    public $user_id;
    public $title_of_post;
    public $grade;
    public $employer_name;
    public $employer_business;
    public $address;
    public $date_commenced;
    public $date_ended;
    public $responsibilities;
    public $leaving_reason;
    public $notice_period;
    public $interview_date;
    public $disciplinary_option;
    public $disciplinary_details;

    

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
                            user_id=:user_id, title_of_post=:title_of_post,
                            grade=:grade, employer_name=:employer_name, employer_business=:employer_business,
                            address=:address, date_commenced=:date_commenced, date_ended=:date_ended,
                            responsibilities=:responsibilities, leaving_reason=:leaving_reason, notice_period=:notice_period,
                            interview_date=:interview_date, disciplinary_option=:disciplinary_option,
                            disciplinary_details=:disciplinary_details";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":title_of_post", $this->title_of_post);
                $stmt->bindParam(":grade", $this->grade);
                $stmt->bindParam(":employer_name", $this->employer_name);
                $stmt->bindParam(":employer_business", $this->employer_business);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":date_commenced", $this->date_commenced);
                $stmt->bindParam(":date_ended", $this->date_ended);
                $stmt->bindParam(":responsibilities", $this->responsibilities);
                $stmt->bindParam(":leaving_reason", $this->leaving_reason);
                $stmt->bindParam(":notice_period", $this->notice_period);
                $stmt->bindParam(":interview_date", $this->interview_date);
                $stmt->bindParam(":disciplinary_option", $this->disciplinary_option);
                $stmt->bindParam(":disciplinary_details", $this->disciplinary_details);

                
                

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
                            title_of_post=:title_of_post, grade=:grade, employer_name=:employer_name, employer_business=:employer_business,
                            address=:address, date_commenced=:date_commenced, date_ended=:date_ended,
                            responsibilities=:responsibilities, leaving_reason=:leaving_reason, notice_period=:notice_period,
                            interview_date=:interview_date, disciplinary_option=:disciplinary_option,
                            disciplinary_details=:disciplinary_details where user_id=:user_id";

                
                $stmt = $this->conn->prepare($query);               

                //echo $this->disciplinary_option;
                //exit;

                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":title_of_post", $this->title_of_post);
                $stmt->bindParam(":grade", $this->grade);
                $stmt->bindParam(":employer_name", $this->employer_name);
                $stmt->bindParam(":employer_business", $this->employer_business);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":date_commenced", $this->date_commenced);
                $stmt->bindParam(":date_ended", $this->date_ended);
                $stmt->bindParam(":responsibilities", $this->responsibilities);
                $stmt->bindParam(":leaving_reason", $this->leaving_reason);
                $stmt->bindParam(":notice_period", $this->notice_period);
                $stmt->bindParam(":interview_date", $this->interview_date);
                $stmt->bindParam(":disciplinary_option", $this->disciplinary_option);
                $stmt->bindParam(":disciplinary_details", $this->disciplinary_details);

                
                

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
        //exit;
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