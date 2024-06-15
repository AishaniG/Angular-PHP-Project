
<?php
class Database{
    public function getConn(){
        $db_host = "localhost";
        $db_name = "";
        $db_user = "";
        $db_pass = "";

    $dsn = 'mysql:_host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8';
    try{
       
       return new PDO($dsn,$db_user,$db_pass);

     }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }


    }
}
