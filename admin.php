<?php require 'include/proving.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <?php 
    define('TITLE','登记人员后台管理系统');
    require "template/header.php";?>
<body>
<div id="header">
    <h1>登记人员后台管理系统</h1>
</div><!--end header tag-->
<div id="content">
    <div id="page_left">
        <ul id="main_meun">
            <li id="mian_meun_i"><img src="images/icon_home.png"/>后台主页</li>
            <li id="mian_meun_t"><img src="images/icon_pages.png"/>今日预登记</li>
            <li id="mian_meun_a"><img src="images/icon_posts.png"/>登记记录</li>
            <li id="mian_meun_m"><img src="images/icon_pages.png"/>账户管理</li>
        </ul>
    </div><!--end page_left tag-->
    <div id="page_content">
        <iframe id="frame_content" name="frame_content" frameborder="0" scrolling="no" width="700px"  src="include/index.php" height="500px"></iframe>
    </div><!--end page_content tag-->
</div>
<?php include "footer.php";?>