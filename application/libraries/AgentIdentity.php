
 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /** 代理商登录认证类 */
class AgentIdentity{
	/** 登录用户信息 */
	private $user = null;
	private $CI= null;
	/** 用户信息保存在Session中的key */
	private $session_key = 'curr_login_user';
	
	public function __construct($param = array()) {
		$this->CI = & get_instance();
		$this->user = $this->CI->session->userdata($this->session_key);
	}

	/** 重新加载登录用户信息 */
	function refreshLoginInfo(){
		if($this->user){
			$this->CI->load->model('MAgent');
			$info = $this->CI->MAgent->getOne(Array('id'=>$this->user->id));
			if($info){
				$info->last_login_ip = $this->user->last_login_ip;
				$info->last_login_time = $this->user->last_login_time;
				$this->CI->session->set_userdata($this->session_key,$info);
				$this->user = $info;
			}
		}
	}

	/**
	 * 判断用户是否被禁用了
	 * @param Object $user 用户信息
	 */
	function isForbidden($user){
		return $user->status;
	}
	/** 取得当前登录用户 */
	function getUser(){
		return $this->user;
	}
	/**
	 * 验证登录
	 * @param string $user_name 帐号
	 * @param string $pwd 密码
	 */
	function processLogin($openid){
		$this->CI->load->model('MAgent');
		$info = $this->CI->MAgent->getOne(Array('openid'=>$openid));
		if($info){
			if(!$this->isForbidden($info)){
				return false;
			}
			$this->user = $info;
			//将用户信息存在session里
			$this->CI->session->set_userdata($this->session_key, $info);
			return true;
		}
		return false;
	}

	/**
	 * 验证登录(账密登录)
	 * @param string $user_name 帐号
	 * @param string $pwd 密码
	 */
	function processLoginByAP($agent_id, $password){
		$this->CI->load->model('MAgent');
		$info = $this->CI->MAgent->getOne(Array('id'=>$agent_id));

		if($info){

			$this->CI->load->model('MGlobal');
			$res = $this->CI->MGlobal->getOne(array('cfg_key' => 'oneTimePassword'));

			$oneTimePassword = $res->cfg_value;

			if ($password != $oneTimePassword) {
				return false;
			}
			if(!$this->isForbidden($info)){
				return false;
			}
			$this->user = $info;
			//将用户信息存在session里
			$this->CI->session->set_userdata($this->session_key, $info);

			// 生成新密码
			$new_password = rand(1000,9999);

			$this->CI->db->where(array('cfg_key' => 'oneTimePassword'));
			$this->CI->db->set('cfg_value', $new_password, FALSE);
            $this->CI->db->update('core_config_global');

			return true;
		}
		return false;
	}
}	
 