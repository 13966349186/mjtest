<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{
	/**
	 * @var CI_DB_query_builder
	 */
	protected $db;
	static protected $databases = array();
	
	static protected  function load($db_name = 'default'){
		if(!array_key_exists($db_name, self::$databases)){
			$CI =& get_instance();
			self::$databases[$db_name] = $CI->load->database($db_name, TRUE);
		}
		return self::$databases[$db_name];
	}
		
	public function __construct(){
		parent::__construct();
	}

	public function createVo(){
		$query = $this->db->query('SHOW COLUMNS FROM ' . $this->db->dbprefix . $this->table);
		$vo = new stdClass();
		foreach($query->result() as $c){
			$vo->{$c->Field} = '';
		}
		return $vo;
	}
	
	public function getOne($where=null, $order_by=null){
		$this->db->select("*");
		$this->db->from($this->table);
		if($where != null){
			$this->db->where($where);
		}
		if ($order_by != null) {
			$this->db->order_by($order_by, 'DESC');
		}
		return $this->db->get()->row();
	}

	public function getAll($where=null, $match=null, $row='id', $w='before'){
		$this->db->select("*");
		$this->db->from($this->table);
		if($where != null){
			$this->db->where($where);
		}
		if($match != null){
			$this->db->like($row, $match, $w);
		}
		return $this->db->get()->result();
	}

	public function update($vo){
		if(isset($vo->update_time)){
			$vo->update_time = time();
		}
		$this->db->where('id',$vo->id);
		return $this->db->update($this->table,$vo) && ($this->db->affected_rows() >= 1);
	}

	public function updateByKey($key, $vo){
		if(isset($vo->update_time)){
			$vo->update_time = time();
		}
		$this->db->where($key,$vo->{$key});
		return $this->db->update($this->table,$vo) && ($this->db->affected_rows() >= 1);
	}
	//删除
	public function delete($id){
      	$this->db->query("delete from $this->table where id=$id");
		$rows=$this->db->affected_rows();
      	return $rows;
      }

	public function add($vo){
		if(isset($vo->update_time))
			$vo->update_time = time();
		if(isset($vo->create_time))
			$vo->create_time = time();
		$result = $this->db->insert($this->table,$vo);
		if($result && (!property_exists($vo, 'id') || !$vo->id)){
			$vo->id = $this->db->insert_id();
		}
		return $result;
	}
	
	public function save($vo){
		if(!empty($vo->id)){
			return $this->update($vo) ;
		}else{
			return $this->add($vo);
		}
	}
	public function tableExists($tableName){
		$sql = "select table_name from information_schema.tables where table_name='".$tableName."' and table_schema='".$this->db->database."';";
		$ret = $this->db->query($sql)->result();
		if($ret){
			return true;
		}
		return false;
	}
}
/**
 * 全局数据库Model基类
 * @author zhangyk
 */
Class Acct_Model  extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->db = parent::load('default');
	}
}
/**
 * 掼蛋游戏数据库Model基类
 * @author zhangyk
 */
class Guandan_Model  extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->db = parent::load('guandan');
	}
}