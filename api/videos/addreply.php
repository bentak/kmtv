<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";

    // ADDS COMMENTS TO A VIDEO

    $request = json_decode(file_get_contents("php://input"));

    if(!isset($request->comment_id)||!isset($request->user_id)||!isset($request->reply)){
        echo json_encode(['status'=>400,'error'=>'enter all fields']);
        return false;
    }

    $comment_id = $request->comment_id;
    $user_id = $request->user_id;
    $reply = $request->reply;

    if(empty($comment_id)||empty($user_id)||empty($reply)){
        echo json_encode(['status'=>400,'error'=>'all fields are required']);
        return false;
    }

    $query = "INSERT INTO reply(comment_id, user_id, reply) VALUES(?,?,?)";
    $sql = "SELECT comment_id FROM comments WHERE comment_id =?";
    $connection = new Db();
    $result = $connection->singleData($sql,[$comment_id]);
    if($result=='no data'){
        echo json_encode(['status'=>400,'error'=>'invalid parameter']);
        return false;
    }
    $response = $connection->Query($query,[$comment_id,$user_id,$reply]);
    if($response==false){
        echo json_encode(['status'=>400, 'error'=>'something went wrong']);
        return false;
    }

    $sql1 = "SELECT  r.reply_id, r.reply,u.username,r.replied_at 
    FROM reply r JOIN users u ON r.user_id = u.user_id  ORDER BY r.reply_id DESC LIMIT 0,1
    ";
    

    $data = $connection->select($sql1);
    echo json_encode(['status'=>200,'data'=>$data]);


?>