<?php

/**
 * 默认页
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Peter.Hu $
*/

define('YSPAY', true);

require(dirname(__FILE__) . '/includes/init.php');
//set_time_limit(0);
	$user_id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_classify = $_SESSION['user_admin']['3'];
    if($user_id&&$user_name){
    }else{
        header('location:login.php');
        exit();
    }
 //判断权限
if(isset($user_classify) && $user_classify=='0'){
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='list'){
    	
    		$page_size = 15;//每页显示条数
			$page_index = 1;//页码
			$numeric_count = 5;//索引长度
			$page_index = isset($_REQUEST['page_index']) ? $_REQUEST['page_index'] : 1;
    		$admin = find_manage_products($page_size,$page_index,$numeric_count);
    		//print_r($admin);
	    	include_once('templates/manage.html');
    }
    //添加职员页面
	 if(isset($_REQUEST['act']) && $_REQUEST['act']=='add'){
    	if(isset($user_classify) && $user_classify=='0'){
    		include_once('templates/manage_add.html');
    	}
    }
    //更改职员信息
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='del'){
        
    }
    //删除职员管理
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='del'){
        $del_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
        $del_id_array = explode("-",$del_id);
        foreach($del_id_array as $manage_id){
            if($manage_id != ''){
                delete_manage_admin($manage_id);
            }
        }
        header('location:manage.php?act=list');
    }
    //提交添加职员信息处理
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='manage_add'){
        if(!empty($_REQUEST['manage_add_name']) && !empty($_REQUEST['manage_add_number'])){
        	$manage_add_name = $_REQUEST['manage_add_name'];
        	$manage_add_number = $_REQUEST['manage_add_number'];
        	$manage_add_classify = $_REQUEST['manage_add_classify'];
        	$manage_add_remark = $_REQUEST['manage_add_remark'];
        	$x = add_manage_admin($manage_add_name,$manage_add_number,$manage_add_classify,$manage_add_remark);
        	if($x){
                echo '<script type="text/javascript">alert("添加成功！");window.location.href="manage.php?act=list";</script>';
            }else{
                echo '<script type="text/javascript">alert("该工号已经存在！");window.location.href="manage.php?act=add";</script>';
            }
        }else{
            echo '<script type="text/javascript">alert("没有填写用户名或工号！");window.location.href="manage.php?act=add";</script>';
        }
    }
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='manage_do_edit'){
        $manage_id = $_REQUEST['id'];
        $user_manage = find_manage_user($manage_id);
        
        if(isset($_POST['submit'])){
            $manage_new = array();
            $manage_new['id'] = $_REQUEST['id'];
            $manage_new['admin_name'] = $_REQUEST['manage_name'];
            $manage_new['admin_number'] = $_REQUEST['manage_number'];
            $manage_new['user_classify'] = $_REQUEST['manage_edit_classify'];
            $manage_new['admin_remark'] = $_REQUEST['manage_remark'] ? $_REQUEST['manage_remark'] : '';
            edit_manage_user($manage_new);
            echo '<script type="text/javascript">alert("修改成功!");window.location.href="manage.php?act=manage_do_edit&id='.$manage_new['id'].'";</script>';
            //include_once('templates/manage_edit.html');
        }
        include_once('templates/manage_edit.html');
    }
    //修改用户信息
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='manage_user_edit'){
        $user_id = $_REQUEST['id'];
        $user_manage = find_rigister_news($user_id);
        //print_r($user_manage);

        if(isset($_POST['submit'])){
            $manage_new = array();
            $manage_new['id'] = $_REQUEST['id'];
            $manage_new['user_last_name'] = $_REQUEST['user_name'];
            $manage_new['user_company'] = $_REQUEST['user_company'];
            $manage_new['user_tel'] = $_REQUEST['user_tel'];
            $manage_new['user_mobile'] = $_REQUEST['user_mobile'];
            $manage_new['user_email'] = $_REQUEST['user_email'];
            find_user_news($manage_new);
            
            echo '<script type="text/javascript">alert("修改成功!");window.location.href="manage.php?act=manage_user_edit&id='.$manage_new['id'].'";</script>';
        
            //include_once('templates/manage_edit.html');
        }
        include_once('templates/user_edit.html');
    }
}else{
    //非管理员显示页面
    if(isset($_REQUEST['act']) && $_REQUEST['act']=='list'){
            $manage_id = $user_id;
            $user_manage = find_manage_user($manage_id);
            include_once('templates/manage_edit.html');
    }
    //职员更改信息处理
    if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'manage_do_edit') {
        $manage_new = array();
        $manage_new['id'] = $_SESSION['user_admin']['0'];
        $manage_new['admin_name'] = $_POST['manage_name'];
        $manage_new['admin_password'] = md5($_POST['manage_password']) ? md5($_POST['manage_password']) : '';
        $manage_new['admin_remark'] = $_REQUEST['manage_remark'] ? $_REQUEST['manage_remark'] : '';
        $manage_old = array();
        $manage_old['id'] = $_SESSION['user_admin']['0'];
        $manage_old['password'] = md5($_POST['manage_old_password']);
        if($manage_old['password'] == $_SESSION['user_admin']['2']){
            //$_SESSION['user_admin']['2'] = $manage_new['admin_password'];
            edit_manage_user($manage_new);
            echo '<script type="text/javascript">alert("修改成功!");window.location.href="manage.php?act=list";</script>';
        }else {
            echo '<script type="text/javascript">alert("密码好像不正确哦！");window.location.href="manage.php?act=list";</script>';
        }
    }
}
?>