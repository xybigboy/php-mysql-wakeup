<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>开机列表</title>

    <link href="//cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <script type="text/javascript " src="h5lock.js"></script>

    <style>
      .margin { margin-bottom: 1em; }
    </style>
  </head>
  <body>

    <?php
    require_once __DIR__.'/./WakeOnLAN.php';
    include("cnn.php");
    //分页的实现原理
//1.获取数据表中总记录数
$sql="select * from wakeup $where "; 
$result=mysqli_query($conn,$sql);
$totalnum=mysqli_num_rows($result);
//每页显示条数
$pagesize=5;
//总共有几页
$maxpage=ceil($totalnum/$pagesize);
$page=isset($_GET['page'])?$_GET['page']:1;
if($page <1)
{
$page=1;
}
if($page>$maxpage)
{
$page=$maxpage;
}
$limit=" limit ".($page-1)*$pagesize.",$pagesize";
$sql="select * from wakeup {$where} order by id desc {$limit}"; //此处加了id降序
// $res=mysqli_query($conn,$sql1);

//     $sql = "select * from wakeup ORDER BY name";
    $res=mysqli_query($conn,$sql);
      session_start();
        
      $cfg = array(
        'psw' => '24865', //密码硬编码
      );

      $action = $_REQUEST['a'];
      
      //开机列表
      if($action=='kj_list'){
        chkIsLogin();
        ?>
        <div class="container">
          <div class="row">
            <h2 class="text-center"> 开机 </h2>
            <div class="dddd">
                <?php while($row= mysqli_fetch_assoc($res)){?>
                <div class="col-md-4 margin"><a class="btn btn-lg btn-primary btn-block" href='?a=kj&m=<?php echo $row['mac'] ?>&p=<?php echo $row['ipaddr'] ?>' role="button" onclick="mymethon(0)"><?php echo $row['name'] ?></a></div>
                <?php }?>
                <?php echo "<center>";
 echo " 当前{$page}/{$maxpage}页 共{$totalnum}条";
echo " <a href='index.php?a=kj_list&page=1{$url}'>首页</a> ";
echo " <a href='index.php?a=kj_list&page=".($page-1)."{$url}'>上一页</a>";
echo " <a href='index.php?a=kj_list&page=".($page+1)."{$url}'>下一页</a>";
echo " <a href='index.php?a=kj_list&page={$maxpage}{$url}'>尾页</a> ";
echo "</center>";
?>
                
              <!--<div class="col-md-4 margin"><a class="btn btn-lg btn-primary btn-block" href="?a=kj&m=B4:2E:99:43:0F:81&p=192.168.110.67" role="button">徐欲（B4-2E-99-43-0F-81）</a></div>-->
              <!--<div class="col-md-4 margin"><a class="btn btn-lg btn-primary btn-block" href="?a=kj&m=08-47-00-00-9B-1A&p=192.168.110.67" role="button">罗（08-47-00-00-9B-1A）</a></div>-->
              <!--<div class="col-md-4 margin"><a class="btn btn-lg btn-primary btn-block" href="?a=kj&m=51-45-49-00-94-E3" role="button">王（51-45-49-00-94-E3）</a></div>-->
              <!--<div class="col-md-4 margin"><a class="btn btn-lg btn-primary btn-block" href="?a=kj&m=51:45:49:00:95:0C" role="button">卢（51:45:49:00:95:0C）</a></div>-->
            </div><!--.ddd-->
            <div style="height:6em;clear:both"></div>
            <div class="col-md-4 margin"><a class="btn btn-lg btn-danger btn-block" href="?a=out" role="button">退出</a></div>
          </div><!--.row-->
        </div><!--.container-->
        <?php

      //开机提交
      }elseif($action=='kj'){
        chkIsLogin();
        $mymac = $_REQUEST['m'];//'50:E5:49:CB:95:0C';
        $myip=$_REQUEST['p'];
        // echo $myip;
        // echo $mymac;
        if(strlen($mymac)<10){
          die('非法mac');
        }
        \PHPGangsta\WakeOnLAN::wakeUp($mymac,$myip);
        // wol("255.255.255.0", $mymac);
        echo '<div class="text-center" style="margin-top:5em;">开机信号已发送到 '.$mymac 
              .'<br /><br /><br /> <a class="btn btn-default btn-primary" href="?a=kj_list" role="button">返回</a>'
              .'</div>'; 
        die;

      //登陆提交
      }elseif($action=='dl'){
        if($_POST['p']==$cfg['psw']){
          $_SESSION['isLogined'] = 'yes';
          header('location:?a=kj_list');
        }else{
            include("linmt.php");
          header('location:?notice='.urlencode('密码错误'));
        }

      //登出
      }elseif($action=='out'){
        
          $_SESSION['isLogined'] = '';
          header('location:.');

      //默认就是登陆页
      }else{
        // 这里构造图案解锁
        ?>
          <style type="text/css">
              body { text-align: center; background-color: #305066; }
              .title { color: #22C3AA; }
          </style>
          <form id="f1" action="" method="POST">
              <input type="hidden" id="f1a" name="a" value="dl" />
              <input type="hidden" id="f1p" name="p" value="" />
          </form>
          <script>
            $(function(){
              // 输出提示
              var notice = '<?php echo htmlspecialchars($_REQUEST["notice"]); ?>';
              if(notice!=''){
                toastr.error(notice);
              }
              //图案解锁
              new H5lock({ 
                  chooseType: 3, 
                  useMode: 8 ,
                  afterInputPsw: function(psw){
                      var pswStr = '';
                      psw.length && psw.forEach(function(c) {
                          pswStr += c.index;
                      }, this);
                      $("#f1p").val(pswStr);
                      $("#f1").submit();
                  },
                  reSetPsw: function(){
                    toastr.info('密码硬编码，暂时不支持重置.');
                  }
              }).init();
            });
          </script>
        <?php
      }
    ?>
    <?php

  //登陆验证
  function chkIsLogin(){
    if( $_SESSION['isLogined'] != 'yes'){
      echo '<h3>无权限操作。</h3>' ;
      header('location:.');
      die;
    }
  }
    ?>

  </body>
    <script type="text/javascript">
           function  mymethon(num){
                  alert("成功");
                  return false
             }
    </script>
</html>


