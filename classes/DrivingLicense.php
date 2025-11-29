<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class DrivingLicense
{
    private $conn;
    private $table_name = "driving_license";


    /// class properties
    public $id;
    public $user_id;
    public $current_license;
    public $car_access;
    public $own_car;
    public $insurance_policy;
    public $penalty_points;
    public $driving_penalty;
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


    
    


    public function create()
    {
        try
        {          
                
                $query = "Insert into ".$this->table_name." set 
                            user_id=:user_id, current_license=:current_license,
                            car_access=:car_access, own_car=:own_car, insurance_policy=:insurance_policy,
                            penalty_points=:penalty_points, driving_penalty=:driving_penalty, duties=:duties";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":current_license", $this->current_license);
                $stmt->bindParam(":car_access", $this->car_access);
                $stmt->bindParam(":own_car", $this->own_car);
                $stmt->bindParam(":insurance_policy", $this->insurance_policy);
                $stmt->bindParam(":penalty_points", $this->penalty_points);
                $stmt->bindParam(":driving_penalty", $this->driving_penalty);
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

       
        var_dump($data);
        return $data;
    }


    public function update()
    {
        try
        {          
                
                $query = "Update ".$this->table_name." set 
                            current_license=:current_license,
                            car_access=:car_access, own_car=:own_car, insurance_policy=:insurance_policy,
                            penalty_points=:penalty_points, driving_penalty=:driving_penalty, duties=:duties where user_id=:user_id";

                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":current_license", $this->current_license);
                $stmt->bindParam(":car_access", $this->car_access);
                $stmt->bindParam(":own_car", $this->own_car);
                $stmt->bindParam(":insurance_policy", $this->insurance_policy);
                $stmt->bindParam(":penalty_points", $this->penalty_points);
                $stmt->bindParam(":driving_penalty", $this->final_grade);
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