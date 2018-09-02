<?php
   if(isset($_FILES['image1']) && isset($_FILES['image2'])){
      $file_name = $_FILES['image1']['name'];
      $file_tmp =$_FILES['image1']['tmp_name'];
      
      $file_name1 = $_FILES['image2']['name'];
      $file_tmp1 =$_FILES['image2']['tmp_name'];
         
      move_uploaded_file($file_tmp,"images/".$file_name);
      move_uploaded_file($file_tmp1,"images/".$file_name1);

         $pat= "images/".$file_name;
         $pat2="images/".$file_name1;
         send($pat);
         send($pat2);
      


   }
   function send($path){
       $conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
     
       $how="INSERT INTO cpupload (path) VALUES ('$path')";
       $res=mysqli_query($conn,$how);
       if($res){
           echo "successfully uploaded image\n";
          echo "file path $path";
          echo "<img src='$path'/>";
         
       }
      /* $que="Select userpic from userprofile limit 1";
       $res2=mysqli_query($conn,$que);
       while(list($userpic) = $res2->fetch_row()){
           echo "$userpic";
           //echo "<img src='$userpic'/>";
       }
       */
   }
?>
