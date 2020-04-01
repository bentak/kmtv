<?php
    include __DIR__."/../../db/db.php";
    if(!isset($_GET['id'])){
        echo json_encode(['status'=>400, 'error'=>'no parameter provided']);
        return false;
    }

    $param = $_GET['id'];
    $query = "SELECT vd.video_id,vd.title, 
    vd.descrption,vd.preview_url,
    vd.video_url,vd.thumbnail_url,vd.views,vd.likes,vd.upload_time, cat.category_name, ad.username as addedby FROM videos vd 
    JOIN categories cat ON vd.category_id = cat.category_id JOIN admin ad ON vd.admin_id = ad.admin_id
    WHERE vd.video_id =?
    ";
    $connection = new Db();
    $result = $connection->singleData($query,[$param]);
    echo json_encode(['status'=>200,'data'=>$result]);
?>