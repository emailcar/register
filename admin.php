<?php
    //设置访问权限，验证是否登陆
    session_start();
    $id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_pass = $_SESSION['user_admin']['2'];
    if($id){
    }else{
        header('location:login.php');
        exit();
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html">
        <meta charset="utf-8">
        <title><?php if(defined('TITLE'))
        {
            print TITLE;
        }else
        {
            print '登记人员后台管理系统';
        }
        ?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/query_password.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
        <script src="js/url.js"></script>
    </head>
<body>
<div id="header">
    <h1>登记人员后台管理系统</h1>
</div><!--end header tag-->
<div id="content">
    <div id="page_left">
        <ul id="main_meun">
            <li id="mian_meun_i">后台主页</li>
            <li id="mian_meun_t">今日预登记</li>
            <li id="mian_meun_a">登记记录</li>
        </ul>
    </div><!--end page_left tag-->
    <div id="page_content">
        <iframe id="frame_content" name="frame_content" frameborder="0" scrolling="no" width="100%" height="100%" src="include/home.php"></iframe>
    </div><!--end page_content tag-->
</div>
<div id="footer">
</div>
</html>