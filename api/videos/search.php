<?php
    include __DIR__."/../../db/db.php";
    include __DIR__."/../middleware/isauthenticated.php";
    if(!isset($_GET['search_query'])){
        echo json_encode(['status'=>400,'error'=>'no search parameter found']);
        return false;
    }

    $search_parameter= $_GET['search_query'];
    $query = "SELECT vd.video_id,vd.title, 
    vd.descrption,vd.preview_url,
    vd.video_url,vd.thumbnail_url,vd.views,vd.likes,vd.upload_time, cat.category_name, ad.username as addedby FROM videos vd 
    JOIN categories cat ON vd.category_id = cat.category_id JOIN admin ad ON vd.admin_id = ad.admin_id
    WHERE MATCH(vd.title,vd.descrption) AGAINST('$search_parameter' IN BOOLEAN MODE) ";
    $connection = new Db();

    $result = $connection->select($query);
    //echo json_encode($search_parameter)
    echo json_encode(['status'=>200, 'data'=>$result]);


?>