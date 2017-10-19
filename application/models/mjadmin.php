<?php
class MJadmin extends Acct_Model{
	protected $table = 'config';
	
    function __construct() {
        parent::__construct();
    }
	
	public function getQuery($limit, $filter){
		$this->db->select('*');
		$this->db->from($this->table);
		//$this->db->order_by('create_time','desc');
		// 过滤出登录奖励
		
		$this->db->where($filter);
		if($limit != null)
			$this->db->limit($limit['limit'],$limit['offset']);
		$rtn = $this->db->get();
		return $rtn;
	}

	public function getCount($filter = array()){
		$query = $this->getQuery(null, $filter);
		return $query->num_rows();
	}

	public function getList($limit = null, $filter = array()){
		$result = $this->getQuery($limit, $filter)->result();
		return $result;
	}
}
