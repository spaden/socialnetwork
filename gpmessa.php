<?php
 class txtmess{
    private $conn,$how,$res;
    public function __construct(){
        $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");

    }
    public function __destruct(){
        mysqli_close($this->conn);
    }
    public function pstmessage(){
        $grpname=$_REQUEST["grpname"];
        $grpdesc=mysqli_real_escape_string($this->conn, $_REQUEST["mesg"]);
        $dt=date('Y-m-d_H:i:s');
       // echo $grpname." ".$grpdesc." ".$dt;
        $this->how="INSERT INTO groups (message,groupname,dtime) VALUES ('$grpdesc','$grpname','$dt')";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "success";
        }  

    }
    public function chkmsg(){
        $grpname=$_REQUEST["grpname"];
        $this->how="SELECT message,dtime,id from groups where groupname='$grpname' order by dtime asc";
        $this->res=mysqli_query($this->conn,$this->how);
        $response = array();
        $response["products"]=array();
        if($this->res){
            $response["info"]="success";
            while(list($msg,$dt,$id)=$this->res->fetch_row()){
                $product=array();
                $product['id']=$id;
                $product['dt']=$dt;
                $product['mesg']=$msg;
                array_push($response['products'],$product);

            }
            echo json_encode($response);

        }else {
            $response["info"]="failed";
        }

    }
    public function flagme(){
        $id=$_REQUEST["flag"];
        $this->how="DELETE FROM groups where id='$id'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "this message will be deleted";
        }
    }


 }
 $kal=new txtmess();
  if(isset($_REQUEST["mesg"])){
       
       $kal->pstmessage();
  }else if(isset($_REQUEST["nwpost"])){
      $kal->chkmsg();
  }else if(isset($_REQUEST["flag"])){
    $kal->flagme();
  }


?>