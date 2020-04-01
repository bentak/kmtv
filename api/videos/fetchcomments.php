<?php
    include __DIR__."/../middleware/headers.php";
    include __DIR__."/../../db/db.php";
    if(!isset($_GET['id'])){
        echo json_encode(['status'=>400, 'error'=>'no parameter provided']);
        return false;
    }

    $id= $_GET['id'];
    $sql ="SELECT COUNT(comment_id) comment_count FROM comments WHERE video_id =?";
    $sql2 ="SELECT COUNT(reply_id) comment_count FROM reply WHERE comment_id =?";
    $query = "SELECT c.comment_id, c.comment, u.username, c.video_id, c.commented_at
    FROM comments c JOIN users u ON c.user_id = u.user_id WHERE video_id=? ORDER BY c.comment_id DESC";

    $connection =new Db();
    $comment_count = $connection->singleData($sql,[$id]);
    if($comment_count=='no data'){
        echo json_encode(['status'=>400,'error'=>'no comment']);
        return false;
    }

    $comments = $connection->singleData($query,[$id]);
    $reply_sql= "SELECT  r.reply_id, r.reply,u.username,r.replied_at 
    FROM reply r JOIN users u ON r.user_id = u.user_id  WHERE r.comment_id=?
    ";
    $comment_reply =array();
    $reply_count = array();
    $total_count =0;
    foreach ($comments as $comment) {
        $replies =$connection->singleData($reply_sql,[$comment->comment_id]);
        $count =$connection->singleData($sql2,[$comment->comment_id]);
       $res = array_merge((array)$comment,['replies'=>$replies]);
        array_push($comment_reply,$res);
        array_push($reply_count,$count[0]);
    }

    $total = array_merge($reply_count,$comment_count);
    foreach ($total as  $item) {
        $total_count = $total_count + $item->comment_count;
    }
    
    echo json_encode(['status'=>200,'data'=>$comment_reply,'total_comment'=>$total_count]);
?>