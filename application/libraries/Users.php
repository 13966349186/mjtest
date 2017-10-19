<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users{
	/**
	 * @var BaseController
	 */
	private $CI;
	private $cacheKey_Stats;
	private $cacheKey_Daily;
	private $cacheKey_Weekly;
	private $cacheKey_Base;
	private $cacheKey_Current;
	
	public function __construct(){
		$this->CI = &get_instance ();
		$this->cacheKey_Base = __CLASS__ . '::user-';
		$this->cacheKey_Current = __CLASS__ . '::current-' . getDayKey ( $this->CI->_time ) . '-';
		$this->cacheKey_Stats = __CLASS__ . '::stats-';
		$this->cacheKey_Daily = __CLASS__ . '::daily-' . getDayKey ( $this->CI->_time ). '-';
		$this->cacheKey_Weekly = __CLASS__ . '::weekly-' . getWeekKey ($this->CI->_time ). '-';
		
		$this->db_cols = $this->CI->config->item('db_cols');
		$this->daily_keys = $this->CI->config->item('daily_keys');
		$this->weekly_keys = $this->CI->config->item('weekly_keys');
	}
	/**
	 * 获取用户基础信息 (数据库 user 表)
	 * @param int $user_id
	 * @return boolean|Ambigous <boolean, unknown>
	 */
	public function getUser($user_id){
		$key =   $this->cacheKey_Base . $user_id;
		if( ($u = $this->CI->memlogic->get($key)) === false ){
			$db = $this->CI->getAcctDb();
			$u = $db->select('*')->where('id',$user_id)->get('user')->row();
			if(!$u){
				return false;
			}
			$this->CI->memlogic->set($key, $u, 86400);
		}
		return $u;
	}
	/**
	 *设置用户基础信息 (数据库 user 表)
	 * @param int $user_id        	
	 * @param object $vo        	
	 * @return bool
	 */
	public function setUser($vo) {
		if (! is_object ( $vo ) || ! isset ( $vo->id )) {
			return false;
		}
		$db = $this->CI->getAcctDb();
		$db->where( 'id', $vo->id );
		if (! $db->update( 'user', $vo )) {
			log_message( 'ERROR', 'FILE:' . __FILE__ . ' line:' . __LINE__ . ' 更新数据失败， 数据：' . var_export ( $vo, true ) );
			return false;
		}
		$this->CI->memlogic->delete($this->cacheKey_Base . $vo->id);
		return true;
	}
	
	/**
	 * 获取用户当前信息
	 * @return CurrentInfoVo
	 */
	public function getCurrentInfo($user_id ){
		$key = $this->cacheKey_Current . $user_id;
		$info = $this->CI->memlogic->get($key, null, $cas_token );
		$cas_token = ($info === false) ? false : $cas_token;
		$info = (is_object($info) && isset($info->id)) ? $info : $this->initCurrentInfo($user_id);
		$info->cas = $cas_token;
		return $info;
	}
	
	/**
	 * @param CurrentInfoVo $info
	 * @return bool
	 */
	public function setCurrentInfo($info){
		if(!isset($info->id) || !isset($info->cas)){
			return false;
		}
		$key = $this->cacheKey_Current . $info->id;
		if($info->cas === false){
			return $this->CI->memlogic->add($key, $info, 86400);
		}else{
			return $this->CI->memlogic->cas($info->cas, $key, $info, 86400);
		}
	}

	/**
	 * 据库表 user_stats 中记录是否存在
	 * @param int $user_id
	 * @return bool
	 */
	public function existUserStats($user_id){
		$key = $this->cacheKey_Stats . $user_id;
		if($this->CI->memlogic->get($key) === false){
			$db = $this->CI->getAcctDb();
			$row = $db->select('user_id')->from('user_stats')->where('user_id', $user_id)->get()->row();
			if(!$row){
				return false;
			}
		}
		return true;
	}
		
	/**
	 * 数据库表 user_stats 插入记录
	 * @param array $data
	 * @return bool
	 */
	public function initUserStats($data){
		if(!array_key_exists('user_id', $data) || !is_numeric($data['user_id'])){
			return false;
		}
		$db = $this->CI->getAcctDb();
		$row = new stdClass();
		$row->user_id = $data['user_id'];
		foreach ($this->db_cols as $k=>$v){
			$row->{$v} = isset($data[$k]) ? $data[$k] : 0;
		}
		if($success = $db->insert('user_stats', $row)){
			$this->CI->memlogic->delete($this->cacheKey_Stats . $data['user_id']);
		}
		return $success;
	} 
	
	/**
	 * @param int $user_id
	 * @return UserInfoVo
	 */
	public function getUserInfo($user_id){
		$keys[] = $this->cacheKey_Stats . $user_id;
		$keys[] = $this->cacheKey_Daily . $user_id;
		$keys[] = $this->cacheKey_Weekly . $user_id;
		$values = $this->CI->memlogic->getMulti($keys);
		if(!array_key_exists($keys[0], $values)){
			$values[$keys[0]] = $this->loadUserStatsDB($user_id);
			$this->CI->memlogic->set($keys[0], $values[$keys[0]], 86400);
		}
		$data = $values[$keys[0]];
		if(array_key_exists($keys[1], $values) && is_array($values[$keys[1]]) ){
			$data += $values[$keys[1]];
		}
		if(array_key_exists($keys[2], $values) && is_array($values[$keys[2]]) ){
			$data += $values[$keys[2]];
		}
		return new UserInfoVo($data);
	}
	
	public function addUserInfo($user_id, $addition){
		$stats_add = array_intersect_key($addition, $this->db_cols);
		$daily_add = array_intersect_key($addition, $this->daily_keys);
		$weekly_add = array_intersect_key($addition, $this->weekly_keys);
		if($weekly_add){
			$cache_key = $this->cacheKey_Weekly . $user_id;
			$expiration = 86400 * 14;
			$i = 0;
			do{
				$value = $this->CI->memlogic->get($cache_key, null , $cas_token);
				$cas_token = ($value === false) ? false : $cas_token;
				$value = is_array($value) ? $value : array();
				if($this->addValue($value, $weekly_add) === false){
					return false;
				}
				if($cas_token === false){
					$success = $this->CI->memlogic->add($cache_key, $value, $expiration);
				}else{
					$success = $this->CI->memlogic->cas($cas_token, $cache_key, $value, $expiration);
				}
			}while( !$success && $i < 5 );
			if($success == false){
				return false;
			}
		}
		if($daily_add){
			$cache_key = $this->cacheKey_Daily . $user_id;
			$i = 0;
			do{
				$value = $this->CI->memlogic->get($cache_key, null , $cas_token);
				$cas_token = ($value === false) ? false : $cas_token;
				$value = is_array($value) ? $value : array();
				if($this->addValue($value, $daily_add) === false){
					return false;
				}
				if($cas_token === false){
					$success = $this->CI->memlogic->add($cache_key, $value, 86400);
				}else{
					$success = $this->CI->memlogic->cas($cas_token, $cache_key, $value, 86400);
				}
			}while( !$success && $i < 5 );
			if($success == false){
				return false;
			}
		}
		if($stats_add){
			$cache_key = $this->cacheKey_Stats . $user_id;
			$i = 0;
			do{
				$value = $this->CI->memlogic->get($cache_key, null , $cas_token);
				$cas_token = ($value === false) ? false : $cas_token;
				$value = $value ? $value : $this->loadUserStatsDB($user_id);
				if($this->addValue($value, $stats_add) === false){
					return false;
				}
				if($cas_token === false){
					$success = $this->CI->memlogic->add($cache_key, $value, 86400);
				}else{
					$success = $this->CI->memlogic->cas($cas_token, $cache_key, $value, 86400);
				}
			}while( !$success && $i < 5 );
			if($success == false){
				return false;
			}
			//更新数据库表 user_stats
			$db = $this->CI->getAcctDb();
			foreach ($value as $k=>$v ){
				isset($this->db_cols[$k]) && $db->set($this->db_cols[$k], $value[$k]);
			}
			if(! $db->where('user_id', $user_id)->update('user_stats') ){
				log_message('ERROR', 'FILE:'.__FILE__.' line:'.__LINE__.' 更新数据库失败：UserId='. $user_id .'  数据='. var_export($stats_add, true));
				return false;
			}
		}
		return true;
	}
	
	private function addValue(&$info, $addition){
		foreach ($addition as $k=>$v){
			switch ($k){
				case COND_RANDOM_CUR_SERIAL_WIN:
				case COND_RANDOM_SERIAL_WIN:
				case COND_ROOM_CUR_SERIAL_WIN:
				case COND_ROOM_SERIAL_WIN:
					break;
				case COND_USER_POINT_NUM:
				case COND_USER_CARD_NUM:
					if(!isset($info[$k]) || $info[$k] + $v < 0 ){
						return false;
					}
					$info[$k] = $info[$k] + $v;
					break;
				case COND_RANDOM_PALY:   //经典模式
					array_key_exists(COND_RANDOM_CUR_SERIAL_WIN, $info) || $info[COND_RANDOM_CUR_SERIAL_WIN] = 0;
					array_key_exists(COND_RANDOM_SERIAL_WIN,         $info) || $info[COND_RANDOM_SERIAL_WIN] = 0;
					array_key_exists(COND_RANDOM_PALY,                    $info) || $info[COND_RANDOM_PALY] = 0;
					
					$win = element(COND_RANDOM_WIN	, $addition, 0);
					if($v > 0 && $win >= $v){ 
						//赢
						$info[COND_RANDOM_CUR_SERIAL_WIN] += $win; 
						$info[COND_RANDOM_SERIAL_WIN] = ($info[COND_RANDOM_CUR_SERIAL_WIN] > $info[COND_RANDOM_SERIAL_WIN]) ? $info[COND_RANDOM_CUR_SERIAL_WIN] : $info[COND_RANDOM_SERIAL_WIN];
					}elseif( $v > 0 && $win < $v){  
						//输
						$info[COND_RANDOM_CUR_SERIAL_WIN] = 0;
					}
					$info[COND_RANDOM_PALY] += $v;
					break;
				case COND_ROOM_PALY:   //房间模式
					array_key_exists(COND_ROOM_CUR_SERIAL_WIN, $info) || $info[COND_ROOM_CUR_SERIAL_WIN] = 0;
					array_key_exists(COND_ROOM_SERIAL_WIN,         $info) || $info[COND_ROOM_SERIAL_WIN] = 0;
					array_key_exists(COND_ROOM_PALY,                    $info) || $info[COND_ROOM_PALY] = 0;
					
					$win = element(COND_ROOM_WIN	, $addition, 0);
					if($v > 0 && $win >= $v){
						//赢
						$info[COND_ROOM_CUR_SERIAL_WIN] += $win;
						$info[COND_ROOM_SERIAL_WIN] = ($info[COND_ROOM_CUR_SERIAL_WIN] > $info[COND_ROOM_SERIAL_WIN]) ? $info[COND_ROOM_CUR_SERIAL_WIN] : $info[COND_ROOM_SERIAL_WIN];
					}elseif($v > 0 && $win < $v){
						//输
						$info[COND_ROOM_CUR_SERIAL_WIN] = 0;
					}
					$info[COND_ROOM_PALY] += $v;
					break;
				default:
					$info[$k] = element($k, $info, 0) + $v;
			}
		}
		return true;
	}
	
	private function initCurrentInfo($user_id){
		$this->CI->load->library('ConfigInfo');
		$u = $this->getUser($user_id);
		$info = new CurrentInfoVo();
		$info->cas = false;
		$info->id = $user_id;
		$info->free_gold_left_times = (int)$this->CI->configinfo->getConfig('freeGoldTimes');
		$info->login_award_left_times = (int)$this->CI->configinfo->getConfig('loginAwardTimes');
		$info->rolette_left_times = $this->CI->configinfo->getConfig('userRoletteTimes');
		$info->rolette_used_times = 0;
		$info->rolette_last_time = 0;
		return $info;
	}
	
	private function loadUserStatsDB($user_id){
		$db = $this->CI->getAcctDb();
		$row = $db->select('*')->from('user_stats')->where('user_id', $user_id)->get()->row();
		$data = array();
		if($row){
			foreach ($this->db_cols as $k=>$v){
				$data[$k] = $row->{$v};
			}
		}
		return $data;
	}
}

class CurrentInfoVo{
	public $cas;
	public $id;
	public $free_gold_left_times;
	public $login_award_left_times;
	public $rolette_left_times;
	public $rolette_used_times;
	public $rolette_last_time;
}

class UserInfoVo  implements ArrayAccess, IteratorAggregate{
	private $values;
	public function __construct($values){
		$this->values =$values;
	}
	public function offsetGet($offset) {
		return isset($this->values[$offset])?$this->values[$offset]:0;
	}
	
	public function offsetSet($offset, $value){
		$this->values[$offset] = $value;
	}
	
	public function offsetExists($offset) {
		return true;
	}
	
	public function offsetUnset($offset) {
		unset($this->values[$offset]);
	}
	
	public function getIterator()	{
		return new ArrayIterator($this->values);
	}
	
}