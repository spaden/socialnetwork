<?php
class pumsg {
    private $conn,$how,$res;
    public function __construct(){
        $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");

    }
    public function __destruct(){
        mysqli_close($this->conn);
    }
    public function ptnmsg(){
        $msg=mysqli_real_escape_string($this->conn, $_REQUEST["mesg"]);
        $usname=$_REQUEST["usuqnm"];
        $dt=date('Y-m-d H:i:s');
        $this->how="INSERT INTO think (message,usname,dt) VALUES ('$msg','$usname','$dt')";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "Thanks for your patience and honest truth";
        }
    }
    public function gtnmsg(){
        $usname=$_REQUEST["usname"];
        $this->how="SELECT message,dt,id from think where usname='$usname' AND dime=0 order by dt desc";
        $this->res=mysqli_query($this->conn,$this->how);
        $response=array();
        $response["products"]=array();
        if($this->res){
            while(list($msg,$dt,$id)=$this->res->fetch_row()){
                $products=array();
                $products["dt"]=$dt;
                $products["id"]=$id;
                $products["msg"]=$msg;
                array_push($response["products"],$products);
            }
            echo json_encode($response);
        }
    }
    public function dlt(){
        $usid=$_REQUEST["del"];
        $this->how="DELETE from think where id='$usid'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "Deleted";
        }
    }
    public function dsme(){
        $usname=$_REQUEST["usname"];
        $this->how="UPDATE think SET dime=1 where usname='$usname'";
        $this->res=mysqli_query($this->conn,$this->how);
        if($this->res){
            echo "Sorry if these offensive thoughts hurt you, no messages will be displayed anymore. Thank You!";
        }
    }
}
$kal=new pumsg();
if(isset($_REQUEST["usuqnm"])){
    $kal->ptnmsg();
}else if(isset($_REQUEST["tme"])){
    $kal->gtnmsg();
}else if(isset($_REQUEST["del"])){
    $kal->dlt();
}else if(isset($_REQUEST["dsme"])){
      $kal->dsme();
}

?>