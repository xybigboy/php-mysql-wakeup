<?php
    include("cnn.php");
    $code=$_POST["num"];
    //分页的实现原理
//1.获取数据表中总记录数
$sql="select * from wakeup where code=$code"; 
$result=mysqli_query($conn,$sql);
$totalnum=mysqli_num_rows($result);
echo $totalnum;
die;
if($totalnum =1)
{
$page=1;
}