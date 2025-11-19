<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

class User
{
    private $conn;
    private $table_name = "users";


    /// class properties
    public $user_id;
    public $email;
    

    public function __construct($db)
    {
        $this->conn = $db;
    }


    // index
    public function user_exist()
    {
        try
        {
            $query = "Select * from ".$this->table_name." where email=:email";

            $stmt = $this->conn->prepare($query);

            $this->email = htmlspecialchars(strip_tags($this->email));

            $stmt->bindParam(":email", $this->email);

            $stmt->execute();

            $exist = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        catch(Exception $e)
        {
            $exist = null;
        }

        return $exist;
    }



    // create User
    public function create()
    {

        try
        {
                                     
                $query = "Insert into ".$this->table_name." set 
                            email=:email";
                
                $stmt = $this->conn->prepare($query);

                // posted values
                $this->email = htmlspecialchars(strip_tags($this->email));
                


                $stmt->bindParam(":email", $this->email);
                

                if ($stmt->execute())
                {
                    $data = [
                        'status' => 'success',
                        'message' => "The User has been successfully created"
                    ];
                    
                }
                else
                {
                    $data = [
                        'status' => 'fail',
                        'message' => "An error occurred creating the User."
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

    public function readBySeries($slug, $page)
    {
            $query = "Select episode_id, series_id, title, sub_title, description, 
                            picture, youtube, page, order_sort, tags from ".$this->table_name." 
                            where slug=:slug and page=:page ORDER BY order_sort";

            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":slug", $slug);
            $stmt->bindParam(":page", $page);

            $stmt->execute();

            return $stmt;
    }

    public function readAllEpisodes()
    {
            $query = "Select e.episode_id, e.series_id, s.name, e.title, e.sub_title, e.description, 
                            e.picture, e.youtube, e.page, e.order_sort, e.tags from episodes e inner join 
                            series s on e.series_id=s.series_id order by e.episode_id desc";                          

            
            $stmt = $this->conn->prepare($query);           

            $stmt->execute();

            return $stmt;
    }


    public function readOneEpisode($id)
    {
            $query = "Select e.episode_id, e.series_id, s.name, e.title, e.sub_title, e.identity, e.description, 
                            e.picture, e.youtube, e.page, e.order_sort, e.tags from episodes e inner join 
                            series s on e.series_id=s.series_id where e.episode_id=:id order by e.episode_id desc";                          

            
            $stmt = $this->conn->prepare($query);           
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt;
    }


    public function readEpisodesBySeries($id)
    {
            $query = "Select e.episode_id, e.series_id, s.name, e.title, e.sub_title, e.identity, e.description, 
                            e.picture, e.youtube, e.page, e.order_sort, e.tags from episodes e inner join 
                            series s on e.series_id=s.series_id where s.series_id=:id order by e.episode_id desc";                          

            
            $stmt = $this->conn->prepare($query);           
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            return $stmt;
    }


    public function readEpisodesBySeriesBySlug($slug)
    {
            $query = "Select e.episode_id, e.series_id, s.name, e.title, e.sub_title, e.identity, e.description, 
                            e.picture, e.youtube, e.page, e.order_sort, e.tags from episodes e inner join 
                            series s on e.series_id=s.series_id where s.slug=:slug order by e.episode_id desc";                          

            
            $stmt = $this->conn->prepare($query);           
            $stmt->bindParam(":slug", $slug);

            $stmt->execute();

            return $stmt;
    }




    // create episode
    public function edit()
    {

        try
        {

        
                $fileName = '';

                if (isset($this->picture) && $this->picture['error'] === UPLOAD_ERR_OK) {
                    $uploadDir  = __DIR__ . '/uploads/';
                
                    // Extract the original file extension (e.g., .jpg, .png)
                    $ext = pathinfo($this->picture['name'], PATHINFO_EXTENSION);


                    //$fileName   = basename($this->picture['name']);

                    // Create a new name based on current Unix timestamp
                    $fileName = time() . '.' . $ext;           

                    
                    $targetPath = $uploadDir . $fileName;

                    

                    if (move_uploaded_file($this->picture['tmp_name'], $targetPath)) {
                        $this->picture = $fileName; // save only the name or relative path
                    } else {

                        $data = [
                            'status' => 'fail',
                            'message' => "File move failed."
                        ];
                        
                        return $data;
                    }
                }

                //var_dump($this->picture);
                if ($fileName != '') {
                            $query = "Update ".$this->table_name." set 
                                        series_id=:series_id, title=:title, sub_title=:sub_title, identity=:identity, 
                                        description=:description, picture=:picture, youtube=:youtube,
                                        page=:page, order_sort=:order_sort, tags=:tags where episode_id=:id";
                }
                else
                {   
                            $query = "Update ".$this->table_name." set 
                                        series_id=:series_id, title=:title, sub_title=:sub_title, identity=:identity, 
                                        description=:description, youtube=:youtube,
                                        page=:page, order_sort=:order_sort, tags=:tags where episode_id=:id";
                            
                }
                
                $stmt = $this->conn->prepare($query);

                // posted values
                $this->series_id = htmlspecialchars(strip_tags($this->series_id));
                $this->title = htmlspecialchars(strip_tags($this->title));
                $this->sub_title = htmlspecialchars(strip_tags($this->sub_title));
                $this->identity = htmlspecialchars(strip_tags($this->identity));
                $this->description = htmlspecialchars(strip_tags($this->description));


                if ($fileName !='')
                {
                    $this->picture = $fileName;
                }
                
                $this->youtube = htmlspecialchars(strip_tags($this->youtube));
                $this->page = htmlspecialchars(strip_tags($this->page));
                $this->order_sort = htmlspecialchars(strip_tags($this->order_sort));
                $this->tags = htmlspecialchars(strip_tags($this->tags));


                $stmt->bindParam(":id", $this->id);
                $stmt->bindParam(":series_id", $this->series_id);
                $stmt->bindParam(":title", $this->title);
                $stmt->bindParam(":sub_title", $this->sub_title);
                $stmt->bindParam(":identity", $this->identity);
                $stmt->bindParam(":description", $this->description);

                if ($fileName !='')
                {
                    $stmt->bindParam(":picture", $this->picture);
                }

                
                $stmt->bindParam(":youtube", $this->youtube);
                $stmt->bindParam(":page", $this->page);
                $stmt->bindParam(":order_sort", $this->order_sort);
                $stmt->bindParam(":tags", $this->tags);

                if ($stmt->execute())
                {
                    $data = [
                        'status' => 'success',
                        'message' => "The Episode has been successfully updated"
                    ];
                    
                }
                else
                {
                    $data = [
                        'status' => 'fail',
                        'message' => "An error occurred updating the Episode."
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

                      
                //var_dump($this->picture);
                
                $query = "Delete from ".$this->table_name."  where episode_id=:id";
                
                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":id", $this->id);
               
                
                if ($stmt->execute())
                {
                    $data = [
                        'status' => 'success',
                        'message' => "The Episode has been successfully deleted"
                    ];
                    
                }
                else
                {
                    $data = [
                        'status' => 'fail',
                        'message' => "An error occurred deleting the Episode."
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



    public function filterEpisodes($query)
    {
            $query = "Select e.episode_id, e.series_id, s.name, e.title, e.sub_title, e.identity, e.description, 
                            e.picture, e.youtube, e.page, e.order_sort, e.tags from episodes e inner join 
                            series s on e.series_id=s.series_id where s.name like '%".$query."%' or 
                            e.title like '%".$query."%' or e.identity like '%".$query."%'  order by e.episode_id desc";                          

            
            $stmt = $this->conn->prepare($query);           

            $stmt->execute();

            return $stmt;
    }

}

    

?>