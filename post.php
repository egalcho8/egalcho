<?php 
include 'db_connect.php';
$folder_parent = isset($_GET['fid'])? $_GET['fid'] : 0;
$folders = $conn->query("SELECT * FROM folders where parent_id = $folder_parent and user_id = '".$_SESSION['login_id']."'  order by name asc");


$files = "SELECT * FROM post   order by date_post DESC";

?>

<?php 
	if (isset($_GET['coment'])) {
		$id = $_GET['coment'];
		$_SESSION['pid']=$_GET['coment'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM post WHERE id=$id");
         $_SESSION['pid']=$id;
		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$user_id = $n['user_id'];
			$pid = $n['pid'];
			$_SESSION['pid']=$n['pid'];
		}
	}
?>
<style>
	.folder-item{
		cursor: pointer;
	}
	.folder-item:hover{
		background: #eaeaea;
	    color: black;
	    box-shadow: 3px 3px #0000000f;
	}
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
input[type=text], input[type=file],input[type=email],input[type=tel] { 
    width: 100%; 
    padding: 12px 20px; margin: 8px 0; 
    display: inline-block;
    border: 1px solid #ccc;
     box-sizing: border-box; 
    }

 /* Set a style for all buttons */ .demo { 
    background-color: #48d1cc;
     color: white; padding: 14px 20px;
     margin: 8px 0; border: none;
     cursor: pointer; width: 100%; 
    } .cancelbtn { 
    width: auto;
     padding: 10px 18px;

     background-color: #4682b4;
      } /* Center the image and position the close button */ 
     .imgcontainer { 

     text-align: center;
      margin: 24px 0 12px 0;
      position: relative; 
 } img.avatar { ;
  border-radius: 50%;
  } .container { 
    padding: 16px; 
  } span.psw {
   float: right; 
   padding-top: 16px;
    } .modal { 
    /* display: none;
      position: fixed; 
     z-index: 1; 
     left: 0;
      top: 0;*/
      width: 100%; 
      height: 100%; 

     overflow: auto;
 background-color: rgb(0,0,0); 
      background-color: rgba(0,0,0,0.4);
      padding-top: 60px;
      
  }
    
      .modal-content { 
    background-color: #fefefe;
     margin: 5% auto 15% auto; 
     border: 1px solid #888;
      width: 400px; 
    } 
    /* The Close Button (x) */
     .close { 
        position: absolute;
         right: 25px; 
     top: 0; color: #000; 
     font-size: 35px; 
     font-weight: bold; 
    } .close:hover, .close:focus {
     color: red;
      cursor: pointer; 
    } /* Add Zoom Animation */ 
    .animate { 
    -webkit-animation: animatezoom 0.6s;
     animation: animatezoom 0.6s 
    } 
    @-webkit-keyframes animatezoom {
     from {
     -webkit-transform: scale(0)
    } to {
    -webkit-transform: scale(1)
  } 
} @keyframes animatezoom { 
    from {transform: scale(0)
    } to {transform: scale(1)
    } 
} 
/* Change styles for span and cancel button on extra small screens */ 
@media screen and(max-width: 300px){
    span.psw { 
        display: block; 
        float: none; 
    } .cancelbtn {
     width: 100%;
      } 
    } 
.edit_btn {
    text-decoration: none;
    padding: 10px 10px;
    background: #2E8B57;
    color: white;
    border-radius: 3px;
    height: 40px;
		width: 40px;
		margin-left: 20px;
}

.del_btn {
    text-decoration: none;
    padding: 10px 10px;
    margin-left: 20px;
    color: white;
    border-radius: 3px;
    background: #800000;
    height: 40px;
		width: 40px;
}
</style>
<?php 
	$id=$folder_parent;
	while($id > 0)
	{ 

	$path = $conn->query("SELECT * FROM folders where id = $id  order by name asc")->fetch_array(); 
?>
	<li class="breadcrumb-item text-success"><?php echo $path['name']; ?></li>
<?php
	$id = $path['parent_id'];	
	} 
?>
<?php if (isset($_SESSION['pid'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['pid']; 
			unset($_SESSION['pid']);
		?>
	</div>
<?php endif ?>
<li class="breadcrumb-item"><a class="text-success" href="index.php?page=files">Files</a></li>
  </ol>
</nav>
<div class="container-fluid">
	<div class="col-lg-12">

		<div class="row">
			<button class="btn btn-success btn-sm" id="new_folder"><i class="fa fa-plus"></i> New Folder</button>
			
			<button class="btn btn-success btn-sm ml-4"  onclick="document. getElementById('id01') .style.display='block'" style="width:auto;"> <i class="fa fa-upload"></i>make post</button>
		</div> <div class="row">
			<div class="col-lg-12">
			<div class="col-md-4 input-group offset-4">
				
  				<input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  				<div class="input-group-append">
   					 <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-search"></i></span>
  				</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><h4><b>Folders</b></h4></div>
		</div>
		<hr>
		<div class="row">
			<?php 
			while($row=$folders->fetch_assoc()):
			?>
				<div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-item" data-id="<?php echo $row['id'] ?>">
					<div class="card-body">
							<large><span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b></large>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<hr>

	<div class="row mt-3 ml-3 mr-3">
			<div class="card col-md-12">
				<div class="card-body">
					<table width="100%">
						
						</tr>
						
						<?php
						$result=mysqli_query($conn,$files) ;
					 if ($result) {
					 	// code...
					 	foreach ($result as $key => $row) {
					 		// code...
					 		echo "<fieldset><p id='pid'>admin<img src='assets/jku.png' ></p>";
					 		echo "<img src='uploads/".$row['image']."'>";
					echo "<p>".$row['descr']."<br><a href='index.php?page=coment' coment=".$row['id']." ><button class='btn btn-success'>coments</button>
					</a><a href='index.php?edit=".$row['id']."' class='edit_btn' >Edit</a><a href='server.php?del=". $row['id']."' class='del_btn'>Delete</a></p></fieldset>";

					 	
					?>

						
							
					<?php
				}
			}
			// endwhile; ?>
					</table>
					
				</div>
			</div>
			
		</div>
	</div>
</div>
<style type="text/css">
	.demo{
		height: 40px;
		width: 40px;
	}#pid{
		margin-left: 90%;
		top: 0;
		border: 3px dotted groove;

	}fieldset{
		border: 3px solid lightgray;
	}#pid img{
		width: 50px;
		height: 50px;
		border-radius: 50%;
		padding-left: 10px;
	}
</style>




<script>  var modal = document.getElementById ('id01'); 
 window.onclick = function(event) { 
 if (event.target == modal) {
  modal.style.display = "none"; 
} } 
</script>

<div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Delete</a>
</div>

<script>
	
	$('#new_folder').click(function(){
		uni_modal('','manage_folder.php?fid=<?php echo $folder_parent ?>')
	})
	$('#new_file').click(function(){
		uni_modal('','manage_files.php?fid=<?php echo $folder_parent ?>')
	})
	$('#new_hfile').click(function(){
		uni_modal('','fileup.php?fid=<?php echo $folder_parent ?>')
	})
	$('.folder-item').dblclick(function(){
		location.href = 'index.php?page=files&fid='+$(this).attr('data-id')
	})
	$('.folder-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu'></div>")
        custom.append($('#menu-folder-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.custom-menu .edit").click(function(e){
		e.preventDefault()
		uni_modal('Rename Folder','manage_folder.php?fid=<?php echo $folder_parent ?>&id='+$(this).attr('data-id') )
	})
	$("div.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
	})
})

	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.file.custom-menu .edit").click(function(e){
		e.preventDefault()
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
	})
	$("div.file.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
	})
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	$('.rename_file').keypress(function(e){
		var _this = $(this)
		if(e.which == 13){
			start_load()
			$.ajax({
				url:'ajax.php?action=file_rename',
				method:'POST',
				data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type'),folder_id:'<?php echo $folder_parent ?>'},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp);
						if(resp.status== 1){
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
						}
					}
				}
			})
		}
	})

})
//FILE


	$('.file-item').click(function(){
		if($(this).find('input.rename_file').is(':visible') == true)
    	return false;
		uni_modal($(this).attr('data-name'),'manage_files.php?<?php echo $folder_parent ?>&id='+$(this).attr('data-id'))
	})
	$(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

});
	$(document).keyup(function(e){

    if(e.keyCode === 27){
        $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

    }

});
	$(document).ready(function(){
		$('#search').keyup(function(){
			var _f = $(this).val().toLowerCase()
			$('.to_folder').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('.card').toggle(true);
					else
					$(this).closest('.card').toggle(false);

				
			})
			$('.to_file').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('tr').toggle(true);
					else
					$(this).closest('tr').toggle(false);

				
			})
		})
	})
	function delete_folder($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_folder',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
	function delete_file($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}

</script>
<br><br>
<div class="container-fluid">
    <div class="form-group">

        <div id="content" >
  
        <div id="id01" class="modal"> 
  <form method="post" action="spost.php" enctype="multipart/form-data" class="modal-content animate" name="my">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
        <input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
        
        
    <div class="container">
    <input type="hidden" name="size" value="1000000">
            <label class="control-label" >upload file</label>
           <input type="file" name="image" class="form-control" id="image">
            
            <label class="control-label" for="descr">description</label>
           <input type="text" name="descr" class="form-control" id="descr">  
           
           <input type="submit" name="upload" class="btn btn-primary">
           
         <div class="container" style="background-color:#f1f1f1">
         <button type="button" onclick="document.getElementById ('id01').style. display='none'" class="cancelbtn"> Cancel</button> 
         
         </span> 
        </div>
  </form>
  </div>
  
    </div>
       
   </div>
  


