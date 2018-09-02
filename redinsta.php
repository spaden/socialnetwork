<?php
  class reins {
    private $conn,$how,$res;
    public function __construct(){
        $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
    }
    public function __destruct(){
        mysqli_close($this->conn);
    }

    public function pstopic(){
        $tpname=mysqli_real_escape_string($this->conn, $_REQUEST["tpnm"]);
        $tpdesc=mysqli_real_escape_string($this->conn, $_REQUEST["tpdsc"]);
        $dt=date('Y-m-d_H:i:s');
        $tpid=$tpname.uniqid()."___2222".$dt;
        $this->how="INSERT INTO antopic (topicname,topicdec,topicid,dtime) VALUES ('$tpname','$tpdesc','$tpid','$dt')";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "topic added successfully, check out how it's doing out there";
        }
    }

    public function getopic(){
       // $tpid=$_REQUEST["tpid"];
        $this->how="SELECT  topicid,id,topicname,topicdec,likes,dislikes,dtime from antopic";
        $this->res=mysqli_query($this->conn,$this->how);
        $response=array();
        $response["products"]=array();
        if($this->res){
            $response["info"]="success";
             while(list($topicid,$id,$topicname,$topicdesc,$likes,$dislikes,$dtime)=$this->res->fetch_row()){
                 $products=array();
                 $products["topicid"]=$topicid;
                 $products["id"]=$id;
                 $products["topicname"]=$topicname;
                 $products["topicdesc"]=$topicdesc;
                 $products["likes"]=$likes;
                 $products["dislikes"]=$dislikes;
                 $products["dtime"]=$dtime;
                 array_push($response["products"],$products);
             }
             echo json_encode($response);
        }else {
            $response["info"]="failed";
        }
    }
    public function flagme(){
        $tpid=$_REQUEST["flid"];
        $this->how="DELETE from antopic where id='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "Topic flagged and we will go through it. Thanks for the feedback";
        }
    }
    public function upvote(){
        $tpid=$_REQUEST["upid"];
        $this->how="UPDATE antopic set likes=likes+1 where id='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
              
        }
    }
    public function dwvote(){
        $tpid=$_REQUEST["dwid"];
        $this->how="UPDATE antopic set dislikes=dislikes+1 where id='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){

        }
    }
    public function mntopic(){
        $tpid=$_REQUEST["mntopic"];
        $this->how="SELECT id,topicname,topicdec,likes,dislikes,dtime from antopic where topicid='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        $response=array();
        $response["products"]=array();
        if($this->res){
            $response["info"]="success";
            while(list($id,$topicname,$topicdec,$likes,$dislikes,$dtime)=$this->res->fetch_row()){
                $products=array();
                $products["id"]=$id;
                $products["topicname"]=$topicname;
                $products["topicdec"]=$topicdec;
                $products["likes"]=$likes;
                $products["dislikes"]=$dislikes;
                $products["dtime"]=$dtime;
                array_push($response["products"],$products);
            }
            echo json_encode($response);
        }else {
            $response["info"]="Error occured";
            echo json_encode($response);
        }
    }
    public function threadtp(){
        $topicid=$_REQUEST["thrid"];
        $tpname=mysqli_real_escape_string($this->conn, $_REQUEST["thrcm"]);
        $dt=date('Y-m-d_H:i:s');
        $this->how="INSERT INTO sptopic (topicid,tpbranch,dtime) VALUES ('$topicid','$tpname','$dt')";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "added";
        }
        
    }
    public function gtsptopic(){
        $tpid=mysqli_real_escape_string($this->conn, $_REQUEST["gtspid"]);

        $this->how="SELECT id,tpbranch,likes,dislikes,dtime from sptopic where topicid='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        $response=array();
        $response["products"]=array();
        if($this->res){
            $response["info"]="success";
            while(list($id,$tpbranch,$likes,$dislikes,$dtime)=$this->res->fetch_row()){
                $products=array();
                $products["id"]=$id;
                $products["tpbranch"]=$tpbranch;
                $products["likes"]=$likes;
                $products["dislikes"]=$dislikes;
                $products["dtime"]=$dtime;
                array_push($response["products"],$products);
            }
            echo json_encode($response);
        }else {
            $response["info"]="Error occured";
        }
    }
    public function flagcom(){
        $spid=$_REQUEST["cmflid"];
        $this->how="DELETE from sptopic where id='$spid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "Topic flagged and we will go through it. Thanks for the feedback";

        }
    }
    public  function likecm(){
        $tpid=$_REQUEST["cmlkid"];
        $this->how="UPDATE sptopic set likes=likes+1 where id='$tpid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){

        }
    }
    public function dislikecm(){
        $spid=$_REQUEST["cmdkid"];
        $this->how="UPDATE sptopic set dislikes=dislikes+1 where id='$spid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){

        }
    }


    public function trending(){
        // $tpid=$_REQUEST["tpid"];
         $this->how="SELECT topicid,id,topicname,topicdec,likes,dislikes,dtime from antopic where (likes+dislikes)>=20";
         $this->res=mysqli_query($this->conn,$this->how);
         $response=array();
         $response["products"]=array();
         if($this->res){
             $response["info"]="success";
              while(list($topicid,$id,$topicname,$topicdesc,$likes,$dislikes,$dtime)=$this->res->fetch_row()){
                  $products=array();
                  $products["topicid"]=$topicid;
                  $products["id"]=$id;
                  $products["topicname"]=$topicname;
                  $products["topicdesc"]=$topicdesc;
                  $products["likes"]=$likes;
                  $products["dislikes"]=$dislikes;
                  $products["dtime"]=$dtime;
                  array_push($response["products"],$products);
              }
              echo json_encode($response);
         }else {
             $response["info"]="failed";
         }
     }
    
   
  }
   $kal=new reins();
   if(isset($_REQUEST["tpnm"])){
       $kal->pstopic();
   }else if(isset($_REQUEST["gtpic"])){
       $kal->getopic();
   }else if(isset($_REQUEST["upid"])){
       $kal->upvote();
   }else if(isset($_REQUEST["dwid"])){
       $kal->dwvote();
   }else if(isset($_REQUEST["flid"])){
       $kal->flagme();
   }else if(isset($_REQUEST["mntopic"])){
       $kal->mntopic();
   }else if(isset($_REQUEST["thrid"])){
       $kal->threadtp();
   }else if(isset($_REQUEST["gtspid"])){
       $kal->gtsptopic();
   }else if(isset($_REQUEST["cmlkid"])){
       $kal->likecm();
   }else if(isset($_REQUEST["cmdkid"])){
       $kal->dislikecm();
   }else if(isset($_REQUEST["cmflid"])){
       $kal->flagcom();
   }else if(isset($_REQUEST["trending"])){
       $kal->trending();
   }



?>