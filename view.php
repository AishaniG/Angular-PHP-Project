<?php
error_reporting(E_ERROR);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if($_SERVER['REQUEST_METHOD'] !== 'GET') :
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' =>'Bad request detected! only get method is allowed.'
    ]);
    exit;
endif;

require 'database.php';

$db = new Database();
$conn = $db->getConn();

if(isset($_GET['id'])){
    $products_id = filter_var($_GET['id'],FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_products',
            'min_range' => 1
        ]
    ]);
}

try{
    $sql = is_numeric($products_id) ? "SELECT * FROM `products` WHERE id='$products_id'" : "SELECT * 
    FROM `products`";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    if($stmt->rowCount() > 0){
        $data = null;

        if(is_numeric($products_id)){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode([
            'success' => 1,
            'data' => $data,
        ]);}
    else{
        echo json_encode([
            'success' => 0,
            'message' => "no data found"
        ]);
    }
    
   
}


catch(PDOException $e){
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}
