<?php
session_start();

include "db.php";
$uid =$_SESSION['uid'];

if(isset($_GET['pid'])){
    $pid =$_GET['pid'];
    $sql=$conn->prepare("Delete from product where pid=? and uid=?");
    $sql->bind_param('ii',$pid,$uid);
    if($sql->execute()){
        echo "<script>alert('Procduct Deleted Successfullly')</script>";
        header("Location:home.php");
    }
}