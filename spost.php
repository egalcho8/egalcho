<?php 

session_start();
include 'db_connect.php';
$pid=rand(1,1000);
$user_id=$_SESSION['login_id'];

if (isset($_POST['upload'])) {
   $image=$_FILES['image']['name'];
    $descr=mysqli_real_escape_string($conn,$_POST['descr']);
    
    

   $target="uploads/".basename($image);
    $sql="INSERT INTO post(image,descr,user_id,pid) VALUES('$image','$descr','$user_id','$pid')";
    mysqli_query($conn,$sql);
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
       // code...
    //echo "file uploadede succe";
    echo '<script>alert("you are make post successfully")</script>';
    $_SESSION['pid']=$pid;
      header("location:index.php");
   }else{
    echo "failed to uploade";
   }
        
   
}

//INSERT INTO stats(totalProduct, totalCustomer, totalOrder)
//VALUES(
   // (SELECT COUNT(*) FROM products),
  //  (SELECT COUNT(*) FROM customers),
   // (SELECT COUNT(*) FROM orders)
//);

?>
<style type="text/css">
    script{
        color: seagreen;
    }
</style>