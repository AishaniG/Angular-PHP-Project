<?php 
class Products{
    public $id;
    public static function getByID($conn,$id,$column = '*'){
        $sql = "SELECT $column
                FROM products
                WHERE id= :id";
    
        $stmt = $conn->prepare($sql);   
        
       
            $stmt->bindValue(':id',$id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS,'Products');
            if($stmt->execute()) {
                return  $stmt->fetch();
            }
    }
    public function delete($conn){

        $sql = "DELETE FROM products
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id',$this->id, PDO::PARAM_INT);

        return $stmt->execute();
}
}