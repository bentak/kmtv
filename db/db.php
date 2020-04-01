<?php

    include __DIR__."/../vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__,'../.env');
    $dotenv->load();

    class Db{
        private $dbhost ;
        private $username;
        private $password;
        private $dbname;
        private $con;

        function __construct(){
            $this->con = $this->dbconnect();
        }

        private function dbconnect(){
            try {
                $this->dbhost =$_ENV['DB_HOST'];
                $this->username=$_ENV['DB_USERNAME'];
                $this->password =$_ENV['DB_PASSWORD'];
                $this->dbname =$_ENV['DB_NAME'];
                $dsn = 'mysql:host='.$this->dbhost .';dbname='.$this->dbname;
                $con = new PDO($dsn, $this->username, $this->password);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                  return $con;
               } catch (PDOException $e) {
                   echo json_encode($e->errorInfo); 
               }
    
        }

        public function select($query){
            try {
                $statement = $this->con->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                if($result == NULL){
                    return 'no data';
                }
                return $result;
            } catch (Exception $e) {
                echo $e;
                
            }

        }

        public function Query($query,$data=array()){
            try {
                $statement = $this->con->prepare($query);
               $result = $statement->execute($data);
                
                return $result;
            } catch (Exception $e) {
                echo $e;
            }

        }

        public function singleData($sql, $param= array()){
            try {
             $stmt = $this->con->prepare($sql);
             $stmt->execute($param);
             
             $result = $stmt->fetchAll();
             if($result==NULL){
                 return 'no data';
             }
             return $result;
            } catch (Exception $e) {
                echo $e;
            }
             
         }

    }



    
    
?>