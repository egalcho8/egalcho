<input type="hidden" name="id" value="<?php echo $id; ?>">

// modified form fields
<input type="text" name="name" value="<?php echo $name; ?>">
<input type="text" name="address" value="<?php echo $address; ?>">
<?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif 
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
}?>