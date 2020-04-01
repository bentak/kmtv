<?php
    include __DIR__."/../../db/db.php";

    // fetches all videos

    $query = "SELECT vd.video_id,vd.title, 
    vd.descrption,vd.preview_url,
    vd.video_url,vd.thumbnail_url,vd.views,vd.likes,vd.upload_time, cat.category_name, ad.username as addedby FROM videos vd 
    JOIN categories cat ON vd.category_id = cat.category_id JOIN admin ad ON vd.admin_id = ad.admin_id
    ORDER BY vd.upload_time DESC
    ";
    $connection =new Db();
    $result = $connection->select($query);
    echo json_encode(['status'=>200,'data'=>$result]);
?>