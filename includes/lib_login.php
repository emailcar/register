<?php
/**
*登陆验证函数
* ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

if (!defined('YSPAY'))
{
    die('Hacking attempt');
}
/**
*
*@param array 登陆提交信息
*
*@return array 登陆权限
*/
function check_login($username,$password){
	$sql = "SELECT * FROM `ys_admin` WHERE admin_name='$username' AND admin_password=md5('$password')";
	return $GLOBALS['db']->getrow($sql);
}
?>