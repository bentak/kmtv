<?php
    // checks if user token exists
   function isauthenticated($connection){

    $headers = apache_request_headers();
    $bearer = explode(" ",$headers['Authorization']);
    $token= $bearer[1];

    $query = "SELECT auth_token from users WHERE auth_token=?";

    $result = $connection->singleData($query,[$token]);

    if($result ="no data"){
        echo json_encode(['status'=>400,'error'=>'not authenticated']);
        return false;
    }

    return true;


   }


    
?>