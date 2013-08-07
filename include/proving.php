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