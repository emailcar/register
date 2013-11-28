<?php
class cls_news_s {
	public $id;
	public $user_last_name;
	public $user_first_name;
	public $user_title;
	public $user_job;
	public $user_company;
	public $user_country;
	public $user_province;
	public $user_city;
	public $user_address;
	public $user_postalcode;
	public $user_tel_area;
	public $user_tel;
	public $user_fax_area;
	public $user_fax;
	public $user_mobile;
	public $user_email;
	public $user_qq;
	public $user_websit;
	public $user_date;
	public $user_profession;
	public $user_objective;
	public $user_interest;
	public $user_road;
	public $user_sign;
	public $data;
	public function register_object($id,$user_last_name,$user_first_name,$user_title,$user_job,$user_company,$user_province,$user_city,$user_address,$user_postalcode,$user_tel_area,$user_tel,$user_fax_area,$user_fax,$user_mobile,$user_email,$user_qq,$user_websit,$user_date,$user_profession,$user_objective,$user_interest,$user_road,$user_sign,$data){
		$this->id = $id;
		$this->user_last_name = $user_last_name;
		$this->user_first_name = $user_first_name;
		$this->user_title = $user_title;
		$this->user_job = $user_job;
		$this->user_company = $user_company;
		$this->user_province = $user_province;
		$this->user_city = $user_city;
		$this->user_address = $user_address;
		$this->user_postalcode = $user_postalcode;
		$this->user_tel_area = $user_tel_area;
		$this->user_tel = $user_tel;
		$this->user_fax_area = $user_fax_area;
		$this->user_fax = $user_fax;
		$this->user_mobile = $user_mobile;
		$this->user_email = $user_email;
		$this->user_qq = $user_qq;
		$this->user_websit = $user_websit;
		$this->user_date = $user_date;
		$this->user_profession = $user_profession;
		$this->user_objective = $user_objective;
		$this->user_interest = $user_interest;
		$this->user_road = $user_road;
		$this->user_sign = $user_sign;
		$this->data = $data;
	}
}
function register_get_mysql($query_up,$query_number){
	$print_number_up = $query_up;
	$print_number = $query_number;
	require 'data/config.php';
		$dbc = mysql_connect($db_host,$db_user,$db_pass);
			if($dbc)
			{
				mysql_select_db($db_name);
				$dbc_w = 'SELECT * FROM user_news ORDER BY  `data` DESC LIMIT '.$print_number_up.','.$print_number.'';
				echo $dbc_w;
				$f = mysql_query($dbc_w);
				if($f)
				{
					$arr = array();
					while ($row = mysql_fetch_assoc($res)){
						$arr[] = $row;
					}
					print_r($arr);
					//print_r($register_list);
					//$register_all_list = new cls_news_s();
					//$register_all_list->register_object($id,$user_last_name,$user_first_name,$user_title,$user_job,$user_company,$user_province,$user_city,$user_address,$user_postalcode,$user_tel_area,$user_tel,$user_fax_area,$user_fax,$user_mobile,$user_email,$user_qq,$user_websit,$user_date,$user_profession,$user_objective,$user_interest,$user_road,$user_sign);
					//return $register_all_list;
					
					/********
					function get_all_list($register_list){
						if($register_list !==false){
							$arr = array();
							while ($row = mysql_fetch_assoc($register_list)){
								$arr[] = $row;
							}
							return $arr;
						}
					}
					$register_list = get_all_list($register_list);
					print_r($register_list);
					********/
					
				}else{
				echo "数据库查询失败！！！";
				}
			}
		mysql_close($dbc);
	}
function register_get_mysql_x($id,$user_last_name,$user_first_name,$user_title,$user_job,$user_company,$user_province,$user_city,$user_address,$user_postalcode,$user_tel_area,$user_tel,$user_fax_area,$user_fax,$user_mobile,$user_email,$user_qq,$user_websit,$user_date,$user_profession,$user_objective,$user_interest,$user_road,$user_sign){
	$sql = "SELECT * FROM user_news ORDER BY `deta` DESC LIMIT 10,15";
	$res = $GLOBALS['db']->getall($sql);
	$register_all_list = new cls_news_s();
	$register_all_list->register_object($id,$user_last_name,$user_first_name,$user_title,$user_job,$user_company,$user_province,$user_city,$user_address,$user_postalcode,$user_tel_area,$user_tel,$user_fax_area,$user_fax,$user_mobile,$user_email,$user_qq,$user_websit,$user_date,$user_profession,$user_objective,$user_interest,$user_road,$user_sign);
	return $register_all_list;
};
?>