<?php include("includes/init.php"); ?>
<?php
    if(!$session->is_signed_in()){ redirect("login.php"); } ?>

<?php

   if(empty($_GET['id'])) {
        redirect($_SERVER['HTTP_REFERER']);
        //header('Location: ' . $_SERVER['HTTP_REFERER']);
   }

   $photo = Photo::find_by_id($_GET['id']);
   
   if($photo){
        $photo->delete_photo();

   }else {
    redirect($_SERVER['HTTP_REFERER']);
   }

?>