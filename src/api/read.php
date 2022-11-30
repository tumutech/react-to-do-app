<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../model/tasks.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Tasks($db);
    $stmt = $items->getTasks();
    $itemCount = $stmt->rowCount();

    // echo json_encode($itemCount);
    if($itemCount > 0){
        $taskArr = array();
        // $taskArr["body"] = array();
        // $taskArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "created" => $created
            );
            array_push($taskArr,$e);

        }
        echo json_encode($taskArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Tasks found.")
        );
    }
?>