<?php
    error_reporting(E_ERROR);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Credentials: true");
    header("Content-Type: application/json; charset=UTF-8");
    
    require 'database.php';
    
    try{
    
        $db = new Database();
        $conn = $db->getConn();
    
        $user_id = $_GET['id'];
    
        $sql = "DELETE FROM `users` WHERE id='$user_id'";
        $stmt = $conn->prepare($sql);
    
        $stmt->execute();
    
        echo json_encode([
        array('message' => "id was deleted")]);
        
    
    
        
    
    }
        catch(PDOException $e){
            http_response_code(500);
            echo json_encode([
                'message' => $e->getMessage()
            ]);
            exit;
        }
    
    