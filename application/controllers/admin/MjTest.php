<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *  User Controller
 *
 */
class MjTest extends BaseController{
	function __construct(){
		parent::__construct();
		$this->load->model('MJadmin');
	}

	//查看
	public function get(){
		$page = $this->input->get('page');
		$page_size = $this->input->get('page_size');
		$pagination = array(
			'limit' => $page_size,
			'offset' => ($page - 1) * $page_size
		);
		// 过滤
		$filter = array();
		if($id = $this->input->get('id')){
			$filter['id'] = $id;
		}
		// 获取记录列表
		$list = $this->MJadmin->getList($pagination, $filter);
		// 获取记录总数
		$total = $this->MJadmin->getCount($filter);
		$data = array(
			'msg' => '获取数据成功',
			'code' => 200,
			'list' => $list,
			'total' => $total
		);
		$this->response($data);
	}
	// 添加
	public function add() {
		//新增
        $u=new stdClass();
		$u->title=$this->input->post('title');
		$u->config=$this->input->post('config');
		$u->remark=$this->input->post('remark');
		$u->update_time = time();
		$u->create_time = time();
        if(!$this->MJadmin->add($u)){
			$this->error(self::$ERROR_DB, '新增失败！' , parent::HTTP_NOT_MODIFIED);
		} 
	}
	//编辑
	public function edit() {
		$data=$this->input->input_stream();
		//更新
		$u = new stdClass();
        $u->id = $data["id"];
        $u->title = $data["title"];
    	$u->config=$data["config"];
    	$u->remark=$data["remark"];
        $u->update_time = time();
        $this->load->model('MJadmin');
        if(!$this->MJadmin->update($u)){
            $this->error(self::$ERROR_DB, '更新失败！' , parent::HTTP_NOT_MODIFIED);
        }  
	}

	//删除
	public function delete(){
		$data=$this->input->input_stream();
		//删除
        $this->load->model('MJadmin');
        if(!$this->MJadmin->delete($data['id'])){
           $this->error(self::$ERROR_PARAM, '删除失败' , parent::HTTP_BAD_REQUEST);
        }
	}

	// 调用接口
	public function getTest($id){
        if(!($test = $this->MJadmin->getOne(array('id' => $id)))){
        	$this->error(1, '不存在', parent::HTTP_NOT_FOUND);
        }
        $config = json_decode($test->config);

        //log_message('ERROR', print_r($config, true));
        //log_message('ERROR', print_r($config->pai, true));
        //log_message('ERROR', print_r(count($config->all), true));

        $pais = array();
        foreach ($config->pai as $key => $value) {
        	foreach ($value as $subKey => $subValue) {
        		if ($key == 1 || $key == 2) {
        			array_push($pais, $this->reMap($value[count($value)-1-$subKey]->value));
/*        			if ($key == 1) {
        				log_message('ERROR', print_r($value[count($value)-1-$subKey]->value, true));
        			}
        			if ($key == 2) {
        				log_message('ERROR', print_r($value[count($value)-1-$subKey]->value, true));
        			}*/
        		}else{
        			//log_message('ERROR', print_r($subValue->value, true));
        			array_push($pais, $this->reMap($subValue->value));
        		}
        	}
        }

        $allPais = array();
        $hun = -1;

		//log_message('ERROR', print_r(count($config->all), true));

        foreach ($config->all as $key => $value) {
        	if ($value->hun) {
        		$hun = $this->reMap($value->value);
        	}
        	for ($i=0; $i < $value->total; $i++) { 
        		array_push($allPais, $this->reMap($value->value));
        	}
        }
        shuffle($allPais);
        $data = array_merge($pais, $allPais);

        log_message('ERROR', print_r($data, true));

		$data = implode(',', $data);
        $this->response(array('test_card_pool' => $data, 'test_hun_remove_card' => $hun));
	}

	public function reMap($value){
		if ($value == -1) {
			return -1;
		}
		$pool = array(
			0 => '1万',
			1 => '2万',
			2 => '3万',
			3 => '4万',
			4 => '5万',
			5 => '6万',
			6 => '7万',
			7 => '8万',
			8 => '9万',
			9 => '1条',
			10 => '2条',
			11 => '3条',
			12 => '4条',
			13 => '5条',
			14 => '6条',
			15 => '7条',
			16 => '8条',
			17 => '9条',
			18 => '1筒',
			19 => '2筒',
			20 => '3筒',
			21 => '4筒',
			22 => '5筒',
			23 => '6筒',
			24 => '7筒',
			25 => '8筒',
			26 => '9筒',
			27 => '东',
			28 => '南',
			29 => '西',
			30 => '北',
			31 => '中',
			32 => '发',
			33 => '白',
			34 => '春',
			35 => '夏',
			36 => '秋',
			37 => '冬',
			38 => '梅',
			39 => '兰',
			40 => '竹',
			41 => '菊'
		);
		foreach ($pool as $key => $item) {
			if ($item == $value) {
				return $key;
			}
		}
	}
}

