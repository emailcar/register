<?php
define('YSPAY', true);
require('../includes/init.php');
$x = $_GET['id']; $user_array = find_rigister_news($x);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"/>
    <meta charset="utf-8"/>
<style>
html,body{
    margin: 0;
    padding: 0;
    font-family: SimHei,'宋体';
}
h1,h2,h3,h4,h5,h6,p,div,img,tr,td,th,ul,li,ol,button{
    margin: 0;
    padding: 0;
    border: 0;
}
a {
text-decoration: none;
display: block;
}
.button{
    margin: 0;
    padding: 0;
    border: 0;
    height: 30px;
    width: 50px;
    border-radius: 2px;
    text-align: center;
    color: #fff;
    background: #3ba354;
    cursor: pointer;
}
.button:hover{
    background: #46BB62;
}
    body{
        
    }
    #page{
        background: url(images/header_bg.jpg) repeat-x;
    }
    #header{
        height: 363px;
        width: 960px;
        margin: 0 auto;
    }
    #header h1{
    padding: 41px 0 0 0px;
    }
    #header h1 a{
        width: 350px;
        height: 40px;
        overflow: hidden;
        color: #fff;
        font-family: SimHei,'宋体';
    }
    #logo{
        margin: 45px 0 0 20px;
        float: left;
        background: url(images/header_logo.png) no-repeat;
        height: 194px;
        width: 194px;
        overflow: hidden;
        line-height: 100em;
    }
    #nav_li{
        padding: 95px 0 0 470px;
    }
    #nav_li li{
        display: inline-block;
        float: left;
        
    }
    #nav_li li a{
        background: url(images/nav_li_bg.png) no-repeat 100% 100%;
        height: 106px;
        width: 106px;
        overflow: hidden;
        line-height: 100em;
    }
    #nav_li li a:hover{
        background: url(images/nav_li_bg_h.png) no-repeat 100% 100%;
    }
    #page_con{
        height: 420px;
        width: 960px;
        margin: 0 auto;
        padding: 20px 0;
    }
    .span_title{
        color: #EC5757;
        margin: 0 5px 0 0;
        font-size: 12px;
    }
    #page_con input {
        border: 1px solid #CCC;
        border-bottom: 1px solid #ddd;
        border-right: 1px solid #ddd;
        height: 16px;
        padding: 3px 6px;
        width: 260px;
        outline-color: #3ba354;
        outline-width: thin;
        text-indent: 10px;
    }
    .page_con_input{
        margin: 20px 0px -8px 105px;
    }
    .page_con_input_title{
        text-align: right;
        float: left;
        width: 140px;
        }
        .user_name{
            padding: 0 10px;
            color: #EC5757;
            display: inline-block;
        }
    .new_title{
        float: left;
        width: 200px;
        text-align: right;
       }
       .new_cont{

       }
    #footer{
        padding: 40px 0;
        height: 40px;
        background: #3B96F5;
        color: #fff;
        text-align: center;
        line-height: 170%;
    }
</style>
<script type="text/javascript">
</script>
</head>
<body>
    <div id="page">
    <div id="header">
        <h1><a href="index.html">韵贵数据服务平台</a></h1>
        <div id="logo">韵贵数据中心</div>
        <div id="nav_li">
            <ul>
                <li><a href="../index.html" style="background-position: 0px 0;">网站主页</a></li>
                <li style="padding: 0 85px;"><a href="../index.php" style="background-position: -186px 0;">系统登录</a></li>
                <li><a href="../index.html" style="background-position: -375pxpx 0;">模拟测试</a></li>
            </ul>
        </div><!--end nav_li-->
    </div><!--end header-->
    <div id="page_con">

        <span class="span_title">**模拟客户提交过后的返回页面过程**</span>
        <div class="page_con_input">尊敬的：<div class="user_name"><?php echo $user_array['user_last_name'].$user_array['user_first_name'];?></div>您好！</div><br/>
        <div class="new_title">您的ID号为：</div><div class="new_cont"><?php echo $user_array['id']?></div><br/>
        <div class="new_title">您的邮箱为：</div><div class="new_cont"><?php echo $user_array['user_email']?></div><br/>
        <div class="new_title">您的公司为：</div><div class="new_cont"><?php echo $user_array['user_company']?></div><br/>
        <div class="new_title"> 二维码：</div><div class="new_cont"> <img src="../includes/code.php?code_content=<?php echo $user_array['id'];?>"/></div>
        <div class="span_title" style="">温馨提示：您可以凭借二维码信息到会场办理登记卡！</div>
    </div><!--end page_con-->
    <div id="footer">
        <p>版权所有：韵贵网络科技</p>
        <p>地址：江苏省昆山市花桥国际商务城绿地大道231号9栋22楼</p>
    </div>
</div>
</body>
</html>
