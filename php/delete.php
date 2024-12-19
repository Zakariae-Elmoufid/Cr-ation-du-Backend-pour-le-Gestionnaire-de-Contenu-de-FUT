<?php include('confige.php'); ?>

<?php 
 if(isset($_GET['id'])) {
    $id = $_GET['id'];
}    

   $query =  "DELETE FROM `player` WHERE `id` = '$id' ";
   $result = mysqli_query($conn,$query);
   

   if(!$result){
       die("query failed".mysqli_error($conn));
   }else{
       header('location:player.php?delete_msg=You have deleted the record ');
   }
?> 