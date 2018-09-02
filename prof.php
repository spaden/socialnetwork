<?php
class prof {
    private $conn,$how,$res,$upd;
   function __construct(){
    $this->conn=mysqli_connect("localhost","nerds","bunchofnerds","pictest");
    $who="kalyantest";
    $this->how="Select description,userpic from userprofile where username='$who'";
    $this->res=mysqli_query($this->conn,$this->how);
    $response=array();
    $response["products"]=array();
    while(list($description,$path)=$this->res->fetch_row()){
      $product=array();
      $product['description']=$description;
      $product['path']=$path;
      array_push($response['products'],$product);
    }
   echo json_encode($response);
   }



}
$c=new prof();




?>