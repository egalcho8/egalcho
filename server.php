<?php 

session_start();
include 'db_connect.php';
//$conn=mysqli_connect('localhost','root','','jinka');
$user_id=$_SESSION['login_id'];
if (isset($_POST['upload'])) {
   $image=$_FILES['image']['name'];
    $descr=mysqli_real_escape_string($conn,$_POST['descr']);
    
    $row=mysqli_real_escape_string($conn,$_POST['row']);
    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $col=mysqli_real_escape_string($conn,$_POST['col']);
    $own=mysqli_real_escape_string($conn,$_POST['owner']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $folder=mysqli_real_escape_string($conn,$_POST['folder_id']);

   $target="uploads/".basename($image);
    $sql="INSERT INTO hard(image,descr,row,col,owner,email,phone,user_id,folder_id,name) VALUES('$image','$descr','$row','$col','$own','$email','$phone','$user_id','$folder','$name')";
    mysqli_query($conn,$sql);
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
       // code...
    //echo "file uploadede succe";
      header("location:index.php");
   }else{
    echo "failed to uploade";
   }
        
   
}



?>