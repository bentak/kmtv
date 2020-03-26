<?php
    include __DIR__."/../../db/db.php";

    if(!isset($_GET['id'])){
        echo json_encode(['status'=>400, 'error'=>'no parameter found']);
        return false;
    }

    $id = isset($_GET['id'])?$_GET['id']:'';
    $query = "UPDATE videos SET likes =likes+1 WHERE video_id=?";
    $connection = new Db();
    $result= $connection->Query($query,[$id]);
    if($result ==false){
        echo json_encode(['status'=>400,'error'=>'something wentwrong']);
    }
    echo json_encode(['status'=>200,'data'=>'update successful'])
?>