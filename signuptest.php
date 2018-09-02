<?php 
   class newsignup {
       private $res,$usname,$uspass,$usemail,$usnumber,$conn,$how;
       public function __construct(){
        $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
       }
       public function __destruct(){
        mysqli_close($this->conn);
       }
       public function checkdata(){
          
           $this->usname=$_REQUEST["usname"];
           $this->uspass=$_REQUEST["uspass"];
           $this->usemail=$_REQUEST["usemail"];
           //$this->usnumber=$_REQUEST["usnumber"];
           $flag=0;
           $flag1=0;
           //$flag3=0;
           $checkemail="SELECT usname,usemail from signup where (usemail = '$this->usemail') OR (usname = '$this->usname')";
           $res=mysqli_query($this->conn,$checkemail);
           while(list($name,$email)=$res->fetch_row()){
                  $flag++;
                  $flag1++;     
           }
           if($flag!=0 && $flag1!=0) echo "User already exists choose a different username and email";
           else {
            //   echo "Sign up successfull\n";
             $this->updatesignup();
           }
        }
        private function updatesignup(){
            $dt=date('Y-m-d_H:i:s');
            $usname=$_REQUEST["usname"].uniqid().$dt;
            $uspass=$_REQUEST["uspass"];
            $usemail=$_REQUEST["usemail"];
            //$usnumber=$_REQUEST["usnumber"];
            $this->how="INSERT INTO signup (usname,uspass,usemail) VALUES ('$usname','$uspass','$usemail')";
             $this->res=mysqli_query($this->conn,$this->how);
             if($this->res){
                 echo "success";
             } else {
                 echo "error";
             }
        }
        public function loginme(){
                $loginuser=$_REQUEST["logusername"];
                $logpass=$_REQUEST["loguserpass"];

                $this->how="Select usname,id from signup where usemail='$loginuser' AND uspass='$logpass'";
                $this->res=mysqli_query($this->conn,$this->how);
                $response=array();
                
                if($this->res){
                    $re2=$this->res;
                    $rowcount=mysqli_num_rows($re2);
                    $response['rowcount']=$rowcount;
                    if($rowcount==0){
                        $response['info']="forbid";    
                    }else {
                        while(list($nameKid,$reffno)=$re2->fetch_row()){
                            $response['nameKid']=$nameKid;
                            //$response['reffno']=$reffno;               
                         }
                         $response['info']="proceed";
                    }       
                }else {
                    
                    $response['info']="forbid";
                    //echo "forbid";
                }
                echo json_encode($response);
        }
   }
   $was=new newsignup();
   if(isset($_REQUEST["usname"])){
       $was->checkdata();
   }else if(isset($_REQUEST["logincheck"])){
         $was->loginme();
   }
?>