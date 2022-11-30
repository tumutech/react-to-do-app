<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../model/Tasks.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Tasks($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    //task values
    $item->name = $data->name;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateTask()){
        echo json_encode("Task updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>