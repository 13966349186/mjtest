<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class MemBase {
	protected $cache = null;
	protected $flag = 0;
	protected $host = false;
	protected $port = false;
	protected $global_pre = '';
	function getPre(){return $this->global_pre;}
	public function __construct($cfg) { 
		$cfg_name = $cfg['name'];
		$CI = &get_instance ();
		$CI->load->config ( 'cache', true );
		$config = $CI->config->item ( 'cache' );
		$this->host = $config [$cfg_name] ['host'];
		$this->port = $config [$cfg_name] ['port'];
		
		if (class_exists ( 'Memcached' )) {
			$cache = new Memcached ();
		} else if (class_exists ( 'Memcache' )) {
			$cache = new Memcache ();
		} else {
			return;
		}
		$cache->addserver ( $this->host, $this->port );
		$this->cache = $cache;
	}
	public function isConnected() {
		return $this->cache ? true : false;
	}
	
	/**
	 * 检索一个元素
	 * （注意：使用Memcache 扩展时，未实现 $cas_token 功能）
	 * @param string $key  	要检索的元素的key
	 * @param callback $cache_cb        	
	 * @param float $cas_token        	
	 * @return boolean
	 */
	public function get($key, $cache_cb = null, &$cas_token = 0) {
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->get (  $key, $cache_cb, $cas_token );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			$cas_token = 0;
			$value = $this->cache->get (  $key );
			if($value === false && is_callable($cache_cb)){
				if($cache_cb($this->cache, $key, $value)){
					$this->cache->set($key, $value);
				}
			}
			return $value;
		}
		return FALSE;
	}
	
	/**
	 * 比较并交换值
	 * 
	 * @param float $cas_token   	与已存在元素关联的唯一的值，由Memcache生成。
	 * @param string $key    	用于存储值的键名。
	 * @param mixed $value   	存储的值。
	 * @param int $expiration  	到期时间，默认为 0
	 */
	public function cas($cas_token, $key, $value, $expiration = 88200) {
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->cas ( $cas_token,  $key, $value, $expiration );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			return $this->cache->set ( $key, $value, $this->flag, $expiration );
		}
		return FALSE;
	}
	
	public function set($key, $value, $expiration = 88200 /**24小时加半小时 **/) { 
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->set (  $key, $value, $expiration );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			return $this->cache->set (  $key, $value, $this->flag, $expiration );
		}
		return FALSE;
	}
	
	public function replace($key, $value, $expiration = 88200) {
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->replace (  $key, $value, $expiration );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			return $this->cache->replace ($key, $value, $this->flag, $expiration );
		}
		return FALSE;
	}
	
	public function delete($key, $expiration = 0) {
		return $this->cache->delete ($key, $expiration );
	}
	
	/**
	 * Set a new expiration on an item
	 * @param string  $key
	 * @param int  $expiration
	 * @return boolean
	 */
	public function touch($key, $expiration = 0) {
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->touch (  $key, $expiration );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			$value = $this->cache->get ( $key );
			return ($value !== false) && $this->cache->set (  $key, $value, $this->flag, $expiration );
		}
		return FALSE;
	}
	
	public function flush() {
		return $this->cache->flush ();
	}
	
	public function getVersion() {
		return $this->cache->getVersion ();
	}
	
	public function increment($key, $offset = 1) {
		return $this->cache->increment (  $key, $offset );
	}
	
	/***
	 * 向一个新的key下面增加一个元素
	 * Memcached::add()与Memcached::set()类似，但是如果 key已经在服务端存在，此操作会失败。
	 * @param string  $key
	 * @param mixed $value
	 * @param int  $expiration
	 */
	public function add($key, $value, $expiration = 88200) {
		if (get_class ( $this->cache ) === 'Memcached') {
			return $this->cache->add ( $key, $value, $expiration );
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			return $this->cache->add ( $key, $value, $this->flag, $expiration );
		}
	}
	
	/**
	 * 检索多个元素
	 * @param array $keys        	
	 * @param array $cas_tokens        	
	 * @return boolean|array
	 */
	public function getMulti($keys, &$cas_tokens = null, $order = false) {
		$result = Array ();
		if (get_class ( $this->cache ) === 'Memcached') {
			if($order){
				return $this->cache->getMulti($keys, $cas_tokens, Memcached::GET_PRESERVE_ORDER);
			}else {
				return $this->cache->getMulti($keys, $cas_tokens);
			}
		} elseif (get_class ( $this->cache ) === 'Memcache') {
			$cas_tokens = array();
			foreach ($keys as $key ) {
				$v = $this->cache->get ($key);
				if( ($v !== false) ||  $order ){
					$result [$key] = ($v === FALSE) ? null : $v;
					$cas_tokens[] = (float)0;
				}
			}
		}
		return $result;
	}
	
}
