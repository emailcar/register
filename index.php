  <?php
/**
 * 框架页
 * ============================================================================
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Peter.Hu $
*/
define('YSPAY', true);
require(dirname(__FILE__) . '/includes/init.php');

$user_id = $_SESSION['user_admin']['0'];
    $user_name = $_SESSION['user_admin']['1'];
    $user_classify = $_SESSION['user_admin']['3'];
    if($user_id&&$user_name){
    }else{
        header('location:login.php');
        exit();
    }

if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'login_out')
{
	unset($_SESSION['user_admin']);
	header('Location: login.php');
	exit();
}

include_once('templates/index.html');
?>