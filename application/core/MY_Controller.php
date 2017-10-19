<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BaseController  extends CI_Controller{
	const HTTP_OK = 200;
	const HTTP_NOT_MODIFIED = 304;
	const HTTP_BAD_REQUEST = 400;
	const HTTP_UNAUTHORIZED = 401;
	const HTTP_FORBIDDEN = 403;
	const HTTP_NOT_FOUND = 404;
	const HTTP_METHOD_NOT_ALLOWED = 405;
	const HTTP_CONFLICT = 409;
	const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
	const HTTP_INTERNAL_SERVER_ERROR = 500;
	
	/** 错误类型：参数错误 */
	protected static $ERROR_PARAM = -901;
	/** 错误类型：数据库错误 */
	protected static $ERROR_DB = -902;
	/** 错误类型：memcache错误 */
	protected static $ERROR_MEM = -903;
	public $_thisModule = null;
	public $_thisController = null;
	public $_thisMethod = null;
	public $_time;
	/** 数据缓存  
	 * @var MemBase $cache
	 * */
	public $cache = null;
	/** 业务缓存  
	 * @var MemBase $memlogic	 
	 * */
	public $memlogic = null;
	protected $_data = array();
	public $_user = null;

	function __construct(){
		parent::__construct();
		$this->_thisModule = $this->router->directory;
		$this->_thisController = $this->router->class;
		$this->_thisMethod = $this->router->method;
		$this->_time = time();
		$this->load->helper('common');

		$this->load->library('MemBase',array('name'=>'data'), 'cache');
		$this->load->library('MemBase',array('name'=>'logic'), 'memlogic');
	}
	
	/** 帐号数据库
	 * @return CI_DB_query_builder
	 *  */
	function getAcctDb(){
		if(!property_exists($this, '_acct_db')){
			$this->_acct_db = $this->load->database('default', true);
		}
		if(!$this->_acct_db->conn_id){
			$this->error(self::$ERROR_DB, '数据库连接失败', $this::HTTP_INTERNAL_SERVER_ERROR);
		}
	
		return $this->_acct_db;
	}
	function assign($key, $value){
		$this->_data[$key] = $value;
	}
	function getAssign(){
		return $this->_data;
	}

	/**
	 * 返回错误信息
	 * @param int $code
	 * @param string $msg
	 * @param int $httpCode HTTP状态码
	 */
	function error($code, $msg, $httpCode){
	//	log_message('error',  __CLASS__  .  ' - ' . $this->_thisModule . $this->_thisController . '/' . $this->_thisMethod . ': [' . $httpCode . '] ' . $msg);
		$this->response(Array('code'=>$code, 'message'=>$msg), $httpCode);
	}
	
	/** 
	 * 输入参数检查 
	 * */

	protected function checkParam($rules){
		$this->load->library('FormValidation');
		$this->formvalidation->set_rules($rules);
		if(!$this->formvalidation->run()){
			$errors = $this->formvalidation->error_array();
			$this->error(self::$ERROR_PARAM, "参数不正确 [". implode('; ', $errors) . ']', $this::HTTP_BAD_REQUEST);
			exit;
		}
	}

	/**
	 * 返回报文
	 * @param string $data
	 * @param string $http_code
	 * @param string $continue
	 */
	public function response($data = NULL, $http_code = NULL, $continue = FALSE)	{
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		header('Content-Type: application/json; charset=UTF-8');
		
		if ($http_code !== NULL){
			$http_code = (int) $http_code;
		}
		// Set the output as NULL by default
		$output = NULL;
	
		// If data is NULL and no HTTP status code provided, then display, error and exit
		if ($data === NULL && $http_code === NULL)	{
			$http_code = $this::HTTP_NOT_FOUND;
		}	elseif ($data !== NULL)	{
			$output = json_encode($data);
		}
	
		// If not greater than zero, then set the HTTP status code as 200 by default
		$http_code > 0 || $http_code = $this::HTTP_OK;

		$this->output->set_status_header($http_code);
		$this->output->set_output($output);
		$this->output->_display();
		exit;
	}
}

/**
 * 后台管理系统接口基类
 * @author wmx
 */
class AdminApiController extends BaseController{
	public $_user_id;
	function __construct() {
		parent::__construct();	
		//初始化用户
		$this->_initUser();
	}

	function _initUser(){
		$this->load->library('UserIdentity');
		$this->_user = $this->useridentity->getUser();
        
		if (!$this->_user) {
			$this->error(1001, '登录会话失效！', parent::HTTP_UNAUTHORIZED);
		}

		// 获取控制器和方法
		$class = $this->router->fetch_class();  
		$method = $this->router->fetch_method();
		$this->assign('_user', $this->_user);
		$permissions=unserialize( $this->session->userdata('UserPower_info'));
		$has = false;
		foreach($permissions as $v){
			foreach($v["children"] as $vv){
				if(isset($vv['authority'][$method])){
					$met=$vv['authority'][$method];
					if(!$vv['permissions'] || !property_exists($vv['permissions'],$met) || !$vv['permissions']->$met){
						$this->error(1002, '您没有权限访问该页面！', parent::HTTP_UNAUTHORIZED);
					}
					$has = true;
					break;
				}
			};
		}
	}
}


/**
 * 代理后台管理系统接口基类
 * @author wmx
 */
class AgentApiController extends BaseController{
	public $_user_id;
	function __construct() {
		parent::__construct();	
		//初始化用户
		$this->_initUser();
	}

	function _initUser(){
		$this->load->library('AgentIdentity');
		$this->_user = $this->agentidentity->getUser();

		if (!$this->_user) {
			$this->error(1001, '登录会话失效！', parent::HTTP_UNAUTHORIZED);
		}

		// 数据库查询当前用户的状态
		$query = $this->db->query("SELECT * FROM core_agent WHERE id = ?", array($this->_user->id));
		$res = $query->row();
		if ($res->status == 0 || $res->status == 1) {
			$this->error(1002, '您的账号被禁用或者未审核通过！', parent::HTTP_UNAUTHORIZED);
		}

		$this->assign('_user', $this->_user);
	}
	
}