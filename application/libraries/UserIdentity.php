<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 用户登录认证类 */
class UserIdentity{
	/** 登录用户信息 */
	private $user = null;
	private $CI= null;
	/** 用户信息保存在Session中的key */
	private $session_key = 'curr_login_user';
	
	public function __construct($param = array('checkLogin'=>TRUE)) {
		$this->CI = & get_instance();
		$this->user = $this->CI->session->userdata($this->session_key);
		if($param['checkLogin']){
			$this->checkLogin();
		}
	}
	/** 检测登录 */
	function checkLogin(){
		if(!$this->user){
/*			if(array_key_exists('REQUEST_URI', $_SERVER)){
				$this->CI->session->set_userdata('login_redirect_url', $_SERVER['REQUEST_URI']);
			}
			redirect('/auth');*/
		}
	}
	/**
	 * 判断密码和指定用户是否匹配
	 * @param Object $user 用户信息
	 * @param string $password 密码
	 */
	function validatePassword($user, $password){
		return ($user != null) && ($user->password == $this->encodePassword($password, $user->salt));
	}
	/** 重新加载登录用户信息 */
	function refreshLoginInfo(){
		if($this->user){
			$this->CI->load->model('MAdmin');
			$info = $this->CI->MAdmin->getOne(Array('id'=>$this->user->id));
			if($info){
				$info->last_login_ip = $this->user->last_login_ip;
				$info->last_login_time = $this->user->last_login_time;
				$this->CI->session->set_userdata($this->session_key,$info);
				$this->user = $info;
			}
		}
	}
	/**
	 * 用户密码加密
	 * @param string $pwd 未加密的原生密码
	 * @return string 加密过后的密码串
	 */
	function encodePassword($pwd, $salt){
		return md5($pwd.$salt);
	}
	/**
	 * 判断用户是否被禁用了
	 * @param Object $user 用户信息
	 */
	function isForbidden($user){
		return $user->forbidden > 0;
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
	function processLogin($user_name, $pwd){
		$this->CI->load->model('MAdmin');
		$info = $this->CI->MAdmin->getOne(Array('account'=>$user_name));
		if($info){
			if(!$this->validatePassword($info, $pwd) || $this->isForbidden($info)){
				return false;
			}
			$this->user = $info;
			//将用户信息存在session里
			$this->CI->session->set_userdata($this->session_key,$info);
			//UserPower::initPermisionInfo($info->id);

			$permissions = $this->getPermissions($info->role_id);
			
			//将权限存到数据库里面
			$this->CI->session->set_userdata('UserPower_info', serialize($permissions));

			$this->CI->MAdmin->recodeLogin($info);
			return true;
		}
		return false;
	}

	/**
	 * 获取权限
 	 */
	function getPermissions($role_id){
		// 初始化权限
		$this->CI->load->config('adminmenus');
		$menuArr = $this->CI->config->item('menus');
		$this->CI->load->model('MPermission');
        $permission_codes = array();
        //获取角色权限
        $page_permissions = $this->CI->MPermission->getPermissionByRoleId($role_id)->result();
        foreach ($page_permissions as $permission_item){
            $permission_codes[$permission_item->page_id] = MPermission::decodePower($permission_item->power);
        }
        foreach ($menuArr as $key => $menu) {
        	$flag = true;
        	foreach ($menu['children'] as $subKey => $page) {
        		if (isset($permission_codes[$page['pageId']])) {
	        		// 拼接页面权限
	        		$menuArr[$key]['children'][$subKey]['permissions'] = $permission_codes[$page['pageId']];
        		}else{
        			// 拼接页面权限
        			$menuArr[$key]['children'][$subKey]['permissions'] = null;
        		}
        		if (isset($permission_codes[$page['pageId']]) && $permission_codes[$page['pageId']]->read) {
        			$menuArr[$key]['children'][$subKey]['hidden'] = false;
        			$flag = false;
        		}else{
        			$menuArr[$key]['children'][$subKey]['hidden'] = true;
        		}
        	}
        	$menuArr[$key]['hidden'] = $flag;
        }
        return $menuArr;
	}

 }

