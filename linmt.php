<!--https://wwr.lanzoui.com/u/yoyodadada?w2-->
<?php
header('Content-Type:text/html;charset=UTF-8');
session_start();
$limit = 2;
//限制的次数
$ip = getip();
// echo $ip;
// $time = date('Y-m-d H:i');
//一小时限制的次数
$time = date('Y-m-d');
// echo $_SESSION[$time][1];
if (isset($_SESSION[$time])) {
    $ipnum = renum($_SESSION[$time], $ip);
} else {
    $ipnum = 0;
}
if ($ipnum >= $limit * 1) {
    echo "<center>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    exit("<h1>系统检测提交次数过多，已风控处理。<br>
    <br>
    <a href='index.php'>返回主页</a></h1>");
    echo "</center>";
    die;
}
if (isset($_REQUEST['url'])) {
    $url = $_REQUEST['url'];
} else {
    $url = 0;
}
$_SESSION[$time][] = $ip;
// echo "<center>";
// echo "提交成功"."<br>";
// echo "<a href='index.php'>返回主页</a>";
// echo "</center>";
function getip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function renum($array, $get)
{
    $n = 0;
    foreach ($array as $val) {
        if ($val == $get) {
            $n++;
        }
    }
    return $n;
}