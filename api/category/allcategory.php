<?php
    include __DIR__."/../../db/db.php";

    $query = "SELECT * FROM categories ORDER BY category_name";

    $connection = new Db();
    $result = $connection->select($query);
    echo json_encode(['status'=>200, 'data'=>$result]);
?>