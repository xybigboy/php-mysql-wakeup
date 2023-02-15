<?php
error_reporting(0);
$servername = "192.168.110.17";
$username = "excl";
$password = "excl";
$dbname = 'excl';
$port = 3307;
  
// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname,$port);
  
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
// echo "连接成功"."<br />";
?>