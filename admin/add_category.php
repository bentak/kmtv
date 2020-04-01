<?php
    include 'connection.php';
$pagetitle = "KMTV";
 include 'header.php';

if(isset($_POST['submit'])){
 $category = mysqli_real_escape_string($connection, $_POST["category"]);


    $sql = "INSERT INTO categories (category_name,created_at) VALUES ('".$category."', NOW()  ) ";
      if ($connection->query($sql)===TRUE) {
  echo "user successfully created";
}

else{
  echo "User not created";
}

  
    

}
?>

<div id="content">

    <h1>Upload</h1>

    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="text" id="title" name="category" placeholder="Category" /><br />

        <input type="submit" value="Upload" name="submit">
    </form>

 

<?php include 'footer.php'; ?>
