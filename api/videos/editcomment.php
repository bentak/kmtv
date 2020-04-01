<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";

    // ADDS COMMENTS TO A VIDEO

    $request = json_decode(file_get_contents("php://input"));

    if(!isset($request->comment_id)||!isset($request->comment)){
        echo json_encode(['status'=>400,'error'=>'enter all fields']);
        return false;
    }

    $comment_id = $request->comment_id;
    
    $comment = $request->comment;

    if(empty($comment_id)||empty($comment)){
        echo json_encode(['status'=>400,'error'=>'all fields are required']);
        return false;
    }

    $query = "UPDATE  comments SET comment=? WHERE comment_id=?";
    $sql = "SELECT comment_id FROM comments WHERE comment_id =?";
    $connection = new Db();
    $result = $connection->singleData($sql,[$comment_id]);
    
    if($result=='no data'){
        echo json_encode(['status'=>400,'error'=>'invalid parameter']);
        return false;
    }
    $response = $connection->Query($query,[$comment,$comment_id]);
   
    if($response==false){
        echo json_encode(['status'=>400, 'error'=>'something went wrong']);
        return false;
    }

    $sql1 = "SELECT c.comment_id, c.comment, u.username, c.video_id 
    FROM comments c JOIN users u ON c.user_id = u.user_id WHERE c.comment_id=?";

    $data = $connection->singleData($sql1,[$comment_id]);
    echo json_encode(['status'=>200,'data'=>$data]);


?>