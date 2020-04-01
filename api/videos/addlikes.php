<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";
// ADDS A +1 LIKE TO A PARTICALUR VIDEO BASED ON VIDEO ID
   
    $request = json_decode(file_get_contents("php://input")); 
   
    
    if(!isset($request->id)||!isset($request->user_id)){
        echo json_encode(['status'=>400, 'error'=>'enter all fields']);
        return false;
    }
    $video_id = $request->id;
    $user_id =$request->user_id;
    
    if(empty($video_id)||empty($user_id)){
        echo json_encode(['status'=>400, 'error'=>'all fields are required']);
        return false;
    }
    
    $sql = "SELECT userid FROM likedvideos WHERE videoid =? AND userid =?";
    $sql1 ="INSERT INTO likedvideos(videoid,userid) VALUES(?,?)";
    $sql2= "SELECT likes FROM videos WHERE video_id = ?";
    $query = "UPDATE videos SET likes =likes+1 WHERE video_id=?";

    $connection = new Db();
    $video_data = $connection->singleData($sql2,[$video_id]); // CHECKS IF VIDEO EXISTS
    $res = $connection->singleData($sql,[$video_id,$user_id]); //CHECKS IF USER ALREADY LIKE VIDEO
    if($res !='no data'){
        echo json_encode(['status'=>400, 'error'=>'already liked video']);
        return false;

    }

    if($video_data =='no data'){
        echo json_encode(['status'=>400,'error'=>'video does not exist']);
        return false;
    }
    $response = $connection->Query($sql1,[$video_id,$user_id]); 
    if($response==false){
        echo json_encode(['status'=>400,'error'=>'like not added']);
        return false;
    }
    $result= $connection->Query($query,[$video_id]); // INCREASES VIDEO LIKES BY 1
    if($result ==false){
        echo json_encode(['status'=>400,'error'=>'something went wrong']);
        return false;
    }
    $data = $connection->singleData($sql2,[$video_id]);
    echo json_encode(['status'=>200,'data'=>$data])
?>