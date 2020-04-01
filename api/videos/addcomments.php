<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";

    // ADDS COMMENTS TO A VIDEO

    $request = json_decode(file_get_contents("php://input"));

    if(!isset($request->video_id)||!isset($request->user_id)||!isset($request->comment)){
        echo json_encode(['status'=>400,'error'=>'enter all fields']);
        return false;
    }

    $video_id = $request->video_id;
    $user_id = $request->user_id;
    $comment = $request->comment;

    if(empty($video_id)||empty($user_id)||empty($comment)){
        echo json_encode(['status'=>400,'error'=>'all fields are required']);
        return false;
    }

    $query = "INSERT INTO comments(video_id, user_id, comment, commented_at) VALUES(?,?,?,?)";
    $sql = "SELECT video_id FROM videos WHERE video_id =?";
    $connection = new Db();
    $result = $connection->singleData($sql,[$video_id]);
    if($result=='no data'){
        echo json_encode(['status'=>400,'error'=>'invalid parameter']);
        return false;
    }
    $response = $connection->Query($query,[$video_id,$user_id,$comment,date("Y-m-d H:i:s")]);
    if($response==false){
        echo json_encode(['status'=>400, 'error'=>'something went wrong']);
        return false;
    }

    $sql1 = "SELECT c.comment_id, c.comment, u.username, c.video_id 
    FROM comments c JOIN users u ON c.user_id = u.user_id ORDER BY c.comment_id DESC LIMIT 0,1";

    $data = $connection->select($sql1);
    echo json_encode(['status'=>200,'data'=>$data]);


?>