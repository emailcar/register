<?php 

/**
 * YiShang 分页类库
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

class cls_page{
	
	public $page_size;//每页显示条数
	public $page_index;//当前页码
	public $total_records;//总记条数
	public $numeric_count;//索引长度
	public $data;//当前页数据
	
	public $numer_start_index; //索引开始页码
	public $numer_end_index;//索引结束页码
	
	/**
	 * 设置分页数据
	 *
	 * @access public
	 * @param int $_page_size
	 * @param int $_page_index
	 * @param int $_total_records
	 * @param int $_numeric_count
	 * @param int $_data
	 * @return null
	 */
	public function set_page($_page_size,$_page_index,$_total_records,$_data,$_numeric_count){
		$this->page_size = $_page_size;
		$this->page_index = $_page_index;
		$this->total_records = $_total_records;
		$this->data = $_data;
		$this->numeric_count = $_numeric_count;
	}
	
	/**
	 * 返回总的页数
	 * @access public
	 * @return int 
	 */
	public function get_total_page()
	{
		return intval(($this->total_records + $this->page_size -1) / $this->page_size);
	}
	
	/**
	 * 返回首页的页码
	 * @access public
	 * @return int
	 */
	public function get_top_page_index()
	{
		return 1;
	}
	
	/**
	 * 返回上一页的页码
	 * @access public
	 * @return int 
	 */
	public function get_previous_page_index()
	{
		if($this->page_index>1)
		{
			return $this->page_index - 1;
		}else{
			return 1;
		}
	}
	
	/**
	 * 返回下一页的页码
	 * @access public
	 * @return int 
	 */
	public function get_next_page_index()
	{
		if($this->page_index < $this->get_total_page())
		{
			return $this->page_index + 1;
		}else {
			return $this->get_total_page() == 0 ? 1: $this->get_total_page();
		}
	}
	
	/**
	 * 返回最后一页的页码
	 * @access public
	 * @return int 
	 */
	public function get_bottom_page_index()
	{
		return $this->get_total_page() == 0 ? 1: $this->get_total_page();
	}
	
	/**
	 * 返回索引列表
	 * @access public
	 * @return int
	 */
	public function get_numeric()
	{
		$this->numer_start_index = intval(($this->page_index - 1)/$this->numeric_count)*$this->numeric_count;
		$this->numer_end_index = intval($this->numer_start_index + $this->numeric_count) > $this->get_total_page() ? $this->get_total_page() : $this->numer_start_index + $this->numeric_count;
		
		$numericArray = array();
		
		for ($i = $this->numer_start_index; $i < $this->numer_end_index; $i++) {
			$numericArray[] = $i+1; 
		}
		
		return $numericArray;
	}
	
	/**
	 * 返回更多索引
	 * @access public
	 * @return int
	 */
	public function get_numeric_more()
	{
		return $this->numer_end_index < $this->get_total_page() ? $this->numer_end_index+1 : "";
	}
}
?>