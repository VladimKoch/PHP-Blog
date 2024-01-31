<?php
ob_start();

class Database{
    public $host = "localhost";
    public $username = "Vlada89";
    public $password = "Tyr2017";
    public $db_name = "blog";

    public $conn;
    public $error;
    public $query;

    /*--------------------------------------------------
                    Class constructor
    --------------------------------------------------*/

    public function __construct(){

        //Call Connect Function
        $this -> connect();
    }

   /*--------------------------------------------------
                    Class Connector
    --------------------------------------------------*/

    private function connect(){
        $this -> conn = new mysqli($this->host, $this -> username, $this -> password, $this->db_name);

        if(!$this -> conn){
            $this -> error = "Connection Failed: ". $this -> conn -> connect_error;
        }

       
      
     }

    /*--------------------------------------------------
                    Table Creator
    --------------------------------------------------*/

    public function createTable(){

            $db_posts = "CREATE TABLE IF NOT EXISTS posts(
                        id INT (11) NOT NULL AUTO_INCREMENT,
                        category INT (11) ,
                        title VARCHAR (255),
                        body TEXT ,
                        author VARCHAR (255),
                        tags VARCHAR (255),
                        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (id))";

            $db_categories = "CREATE TABLE IF NOT EXISTS categories(
                            id INT(11) NOT NULL AUTO_INCREMENT,
                            name VARCHAR (255) NOT NULL,
                            PRIMARY KEY (id))";

                 if($this -> conn -> query($db_posts) && $this -> conn -> query($db_categories) === false){

                     die("Error creatin table: " . $this->conn->error);       
                 }
                 
            }



   /*--------------------------------------------------
                    Selector from DB
    --------------------------------------------------*/
     
    public function select($query){

        $result = $this -> conn -> query($query) or die($this -> conn -> error.__LINE__);
        if($result->num_rows > 0){
            return $result;}

            else{
                return false;
            }

        }

        
    /*--------------------------------------------------
                        Insert to DB
    --------------------------------------------------*/
        
        public function insert($query){
            $insert_row = $this -> conn -> query($query) or die($this -> conn -> error.__LINE__);
        
            // Validate Insert

            if($insert_row){
                
                header("Location: index.php?msg=".urlencode('Post přidán'));
                 exit();
            
            }

            else {
                die ('Error: ('. $this->conn->errno . ') ' . $this->conn->error);
            }
        
        
        }
    /*--------------------------------------------------
                        Update in DB
    --------------------------------------------------*/
        
    public function update($query){
        $update_row = $this -> conn -> query($query) or die($this -> conn -> error.__LINE__);
    
        // Validate Insert

        if($update_row){
            header("Location: index.php?msg=".urlencode('Post aktualizován'));
            exit();
        }

        else {
            die ('Error: ('. $this->conn->errno . ') ' . $this->conn->error);
        }
    
    
    }
    
    /*--------------------------------------------------
                        Delete from DB
    --------------------------------------------------*/
        
    public function delete($query){
        $delete_row = $this -> conn -> query($query) or die($this -> conn -> error.__LINE__);
    
        // Validate Insert

        if($delete_row){
            header("Location: index.php?msg=".urlencode('Post vymazán'));
            ob_end_clean();
            exit();
        }

        else {
            die ('Error: ('. $this->conn->errno . ') ' . $this->conn->error);
        }
    
    
    }   
        
        
        
    }

     
     


?>

