<?php
  class angp {
    private $conn,$how,$res;
     function __construct(){
         $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
     }
     function createnew(){
        $usname=$_REQUEST["grpname"].date('Y-m-d H:i:s').uniqid();
        $grpname=mysqli_real_escape_string($this->conn,$usname);   
        //echo $fin2." groupname ok  ";
        $groupid=uniqid();
        //echo $groupid." groupid ok     ";
       // $grpdesc=mysqli_real_escape_string($this->conn, $_REQUEST["grpdesc"]);
       // echo $usname. " ///////////////////// ". $gpdesc;
        //echo $grpdesc." groupdesc ok    ";
        $cat=date('Y-m-d_H:i:s');
       // echo $cat."  date ok   ";
        $this->how="INSERT INTO groupuniq (groupname,createdat) VALUES ('$grpname','$cat')";
         //echo $grpname;
        $this->res=mysqli_query($this->conn,$this->how);    
        $response=array();
        
        if($this->res){
           $response["info"]="success";
           $response["link"]="enter.php?grpname=".$grpname;
          // echo json_encode($response);
        }else {
            $response["info"]="failed";
        }
        echo json_encode($response);
    }

    function __destruct(){
        mysqli_close($this->conn);
    }

  }

  if(isset($_REQUEST["grpname"])){
      $kal=new angp();
      $kal->createnew();
  }
  


?>