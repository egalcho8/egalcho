<?php
      session_start();
      require_once 'db_connect.php';
      if(isset($_POST['post']) && !empty($_POST['post'])){
           $post=$_POST['post'];
           $_SESSION['post']=$_POST['post'];

           try{
               $newComment=DB::getInstance();
               $newComment->insert('post',array('posts'=>$post));
              }catch(Exception $e){
                 echo $e->getMessage();
              }
           header('HTTP/1.1 303 see other');
           header('Location:'.$_SERVER['PHP_SELF']);
        }    
?>
<html>
<head>
<style>
    #formdiv{width:347px;height:120px;background:#dfe3ee;position:relative;border:1px dashed black;top:0px;left:300px;padding:5px; margin-bottom:3px;

    }
    #cmntbox{
        width:347px;background:#dfe3ee;position:relative;border:1px solid black;left:300px;padding:5px;
    }
    .repText{
        width:100%;background:#f7f7f7;position:relative;border:1px solid black;padding:3px;resize:none;}
    }
</style>
</head>
</body>
<div id='formdiv'>
    <form action='' method='POST'>
        <textarea name='post' placeholder="what's on your mind !" cols='40' rows='3'></textarea>
        <input type='submit' name='submit' value='post comment' style='float:right;width:100px;height:30px;background:#3b5998;color:white;'>
    </form>
</div>
<?php 

      $newComment=DB::getInstance();
      $results=$newComment->getComment('SELECT','post','posts')->result();

      foreach($results as $result=>$val){
?>
    <div  id='cmntbox'><?php 
     echo $val->posts;
     echo '</br><hr>';?>
     <form>
         <input type="hidden" name="postId" value="<?php echo $val->postId ?>" />
         <textarea name='myrep' id='myreply' class='repText'></textarea>
         <input type='button' class='reply' value='reply' style='width:50px;height:30px;background:#3b5998;color:white;' >
     </form>
</div>
<?php 
      }
?>
<script>
   var reply=document.getElementsByClassName('reply');
   var repText=document.getElementsByClassName('repText');
   for(i=0;i<reply.length;i++){
       (function(i){
            reply[i].addEventListener('click',function(e){
                  var xmlHttp=new XMLHttpRequest();
                  xmlHttp.onreadystatechange=function(){
                      if(xmlHttp.readyState==4 && xmlHttp.status==200){
                           //do nothing
                      }else{
                           alert('there was a problem ');
                      }

                  }  
                  var parameters='myrep='+document.getElementById('myreq').value
                  xmlHttp.open("POST", "insertcomment.php", true);
                  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xmlHttp.send(parameters);
                  }
            });
       })

       (i);

   }<input name="ipassthepostidhere" type="text" data-id="12" class="commentBox form-control input-sm">
<input name="ipassthepostidhere2" type="text" data-id="13" class="commentBox form-control input-sm">
<script>
$(".commentBox").keyup(function(e) {
   if(e.keyCode == 13) {
        var comment = e.currentTarget.value;   // e.currentTarget or this is a normal DOM-Element
        var postId = $(this).data('id'); // $(this) is the jQuery-Element
        // or
        // var comment = this.value;
        alert(postId + ' ' + comment);
   }
});
</script>
</script>
</body>
</html>