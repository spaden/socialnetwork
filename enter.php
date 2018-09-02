<?php
  class redirect {
    private $conn,$how,$res;
    public function __construct(){
        $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
    }
    public function querygroup(){
        $grpname=$_REQUEST["grpname"];
        $this->how="SELECT * from groupuniq where groupname='$grpname'";
        $this->res=mysqli_query($this->conn,$this->how);
        $rowcount=mysqli_num_rows($this->res);
        if($rowcount==0){
            echo "No group exists in this link";
        }else {
            echo $grpname;
            $cookie_name = "sename";
            $cookie_value = $grpname;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            header("Location: freedom.php");
        }

    }
  }
  if(isset($_REQUEST['grpname'])){
      $kal=new redirect();
      $kal->querygroup();
  }

?>