<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class PersonalDetail
{
    private $conn;
    private $table_name = "personal_details";

    public $id;
    public $user_id;
    public $post_title;
    public $surname;
    public $forenames;
    public $former_surnames;
    public $address;
    public $home_phone;
    public $business_phone;
    public $mobile_phone;
    public $fax_no;
    public $email;
    public $nat_insurance_no;
    public $need_work_permit;
    public $permit_expire_date;



    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function personal_details_exist()
    {
        try
        {
            $query = "Select * from ".$this->table_name." where user_id=:user_id";

            $this->user_id = htmlspecialchars(strip_tags((string) $this->user_id));

            $stmt = $this->conn->prepare($query);

            
            $stmt->bindParam(":user_id", $this->user_id);
            

            $stmt->execute();

            $exist = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        catch(Exception $e)
        {
            $exist = null;
        }

        return $exist;
    }

    public function create()
    {
        try
        {          
                
                $query = "Insert into ".$this->table_name." set 
                            user_id=:user_id, post_title=:post_title, surname=:surname, forenames=:forenames, former_surnames=:former_surnames, 
                            address=:address, home_phone=:home_phone, business_phone=:business_phone, mobile_phone=:mobile_phone, 
                            fax_no=:fax_no, email=:email, nat_insurance_no=:nat_insurance_no, need_work_permit=:need_work_permit, 
                            permit_expire_date=:permit_expire_date";
                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":post_title", $this->post_title);
                $stmt->bindParam(":surname", $this->surname);
                $stmt->bindParam(":forenames", $this->forenames);
                $stmt->bindParam(":former_surnames", $this->former_surnames);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":home_phone", $this->home_phone);
                $stmt->bindParam(":business_phone", $this->business_phone);
                $stmt->bindParam(":mobile_phone", $this->mobile_phone);
                $stmt->bindParam(":fax_no", $this->fax_no);
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":nat_insurance_no", $this->nat_insurance_no);
                $stmt->bindParam(":need_work_permit", $this->need_work_permit);
                $stmt->bindParam(":permit_expire_date", $this->permit_expire_date);
                

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
                          post_title=:post_title, surname=:surname, forenames=:forenames, former_surnames=:former_surnames, 
                          address=:address, home_phone=:home_phone, business_phone=:business_phone, mobile_phone=:mobile_phone, 
                          fax_no=:fax_no, email=:email, nat_insurance_no=:nat_insurance_no, need_work_permit=:need_work_permit, 
                          permit_expire_date=:permit_expire_date where user_id=:user_id";
                
                $stmt = $this->conn->prepare($query);               


                $stmt->bindParam(":user_id", $this->user_id);
                $stmt->bindParam(":post_title", $this->post_title);
                $stmt->bindParam(":surname", $this->surname);
                $stmt->bindParam(":forenames", $this->forenames);
                $stmt->bindParam(":former_surnames", $this->former_surnames);
                $stmt->bindParam(":address", $this->address);
                $stmt->bindParam(":home_phone", $this->home_phone);
                $stmt->bindParam(":business_phone", $this->business_phone);
                $stmt->bindParam(":mobile_phone", $this->mobile_phone);
                $stmt->bindParam(":fax_no", $this->fax_no);
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":nat_insurance_no", $this->nat_insurance_no);
                $stmt->bindParam(":need_work_permit", $this->need_work_permit);
                $stmt->bindParam(":permit_expire_date", $this->permit_expire_date);
                

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
            var_dump($e->getMessage());
        }

        //var_dump($data);
        return $data;
        
    }

}


?>