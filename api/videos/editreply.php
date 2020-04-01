<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";

    // ADDS COMMENTS TO A VIDEO

    $request = json_decode(file_get_contents("php://input"));

    if(!isset($request->reply_id)||!isset($request->reply)){
        echo json_encode(['status'=>400,'error'=>'enter all fields']);
        return false;
    }

    $reply_id = $request->reply_id;
    
    $reply = $request->reply;

    if(empty($reply_id)||empty($reply)){
        echo json_encode(['status'=>400,'error'=>'all fields are required']);
        return false;
    }

    $query = "UPDATE reply SET reply =? WHERE reply_id=?";
    $sql = "SELECT reply_id FROM reply WHERE reply_id =?";
    $connection = new Db();
    $result = $connection->singleData($sql,[$reply_id]);
    
    if($result=='no data'){
        echo json_encode(['status'=>400,'error'=>'invalid parameter']);
        return false;
    }
    $response = $connection->Query($query,[$reply,$reply_id]);
   
    if($response==false){
        echo json_encode(['status'=>400, 'error'=>'something went wrong']);
        return false;
    }

    $sql1 = "SELECT  r.reply_id, r.reply,u.username,r.replied_at 
    FROM reply r JOIN users u ON r.user_id = u.user_id  WHERE r.reply_id=?
    ";
    $data = $connection->singleData($sql1,[$reply_id]);
    echo json_encode(['status'=>200,'data'=>$data]);


?>