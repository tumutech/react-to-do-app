<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../model/Tasks.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Tasks($db);
    
    $data = json_decode(file_get_contents("php://input"));
    echo($data);
    $item->id = $data->id;
    
    if($item->deleteTask($data->id)){

        echo json_encode("Task deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>