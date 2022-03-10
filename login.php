<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>jku file manegment system</title>
 	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<?php include('./header.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:#28a745;
		display: flex;
		align-items: center;
	}
	#login-right .card{
		margin: auto
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    padding: .5em 0.8em;
    color: #000000b3;
}.col-md-12{
	margin-left: 10%;
	margin-right: 30px;
}.fieldset{
	width:100px;
	height: 100px;
}.demo{
	height: 100px;
}
</style>

<body>


  <main id="main" class=" alert-info">
  		<div id="login-left">
  			<div class="logo">
  				<img src="assets/jku.png">
  			</div>
  		</div>
  		<div id="login-right">
  			<div class="w-100">
  				<fieldset>
  				<div class="row">
  					<div class="col-md-12">
  						<?php 
            include('db_connect.php');
            $sql="SELECT *FROM post ORDER BY id DESC LIMIT 1";
            $result=mysqli_query($conn,$sql);
            if ($result) {
            	// code...
            	foreach ($result as $key => $row) {
            		echo "<p><marquee>".$row['descr']."</marquee></p>";
            		 echo" <fieldset><marquee><img src='uploads/".$row['image']."' class='demo'>"."</marquee></fieldset>";
            		// code...
            	}
            }

  						?>
  					</div>
  				</div>
  			</fieldset>
  				<h4 class="text-success text-center"><b>WEB BASED JKU File Management System</b></h4>
  				<br>
  			
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label text-success">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label text-success">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   		</div>

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.reload('index.php?page=home');
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>