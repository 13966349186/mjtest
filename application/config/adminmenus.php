<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['menus'] = array(
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '权限管理',
		'iconCls' => 'fa fa-user-circle',
		'children' => array(
			array(
				'path' => '/account',
				'component' => 'Account',
				'name' => '账户管理',
				'hidden' => false,	
				'pageId' => 1001,
				'authority'=>array(
					"account_get"=>'read',
					"account_post"=>'add',
					'account_put'=>'edit',
					'account_patch'=>'edit',
					'forgot_password_post'=>'edit',
					'account_delete'=>'delete',
					),
			),
			array(
				'path' => '/role',
				'component' => 'Role',
				'name' => '角色管理',
				'hidden' => false,	
				'pageId' => 1002,
				'authority'=>array(
					"roles_get"=>'read',
					"permissions_get"=>'read',
					"permissions_post"=>'add',
					'roles_put'=>'edit',
					'roles_patch'=>'edit',
					'roles_delete'=>'delete',
					),
			)			
		)
	),
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '基础配置',
		'iconCls' => 'fa fa-cogs',
		'children' => array(
			array(
				'path' => '/game',
				'component' => 'Game',
				'name' => '游戏管理',
				'hidden' => false,	
				'pageId' => 3001,
				'authority'=>array(
					"games_get"=>'read',
					'games_put'=>'edit',
				),
			),
			array(
				'path' => '/server',
				'component' => 'Server',
				'name' => '服务器管理',
				'hidden' => false,	
				'pageId' => 3002,
				'authority'=>array(
					"servers_get"=>'read',
					'servers_put'=>'edit',
					'servers_clearcache'=>'edit',
				),
			),
			array(
				'path'=>'/gameconfig',
				'component'=>'GameConfig',
				'name'=>'游戏配置管理',
				'hidden'=>false,
				'pageId'=>3003,
				'authority'=>array(
					"gameconfig_get"=>'read',
					'gameconfig_put'=>'edit',
					'gameconfig_post'=>'add',
					'gameconfig_delete'=>'delete',
				)
			),		
		)
	),
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '运营配置',
		'iconCls' => 'fa fa-cog',
		'children' => array(
			array(
				'path' => '/global',
				'component' => 'Global',
				'name' => '全局配置',
				'hidden' => false,	
				'pageId' => 3101,
				'authority'=>array(
					"globals_get"=>'read',
					"globals_put"=>'edit'
					),
			),
			array(
				'path' => '/cup',
				'component' => 'Cup',
				'name' => '奖杯配置',
				'hidden' => false,	
				'pageId' => 3102,
				'authority'=>array(
					"cups_get"=>'read',
					"cups_post"=>'add',
					'cups_put'=>'edit',
					),
			),
			array(
				'path' => '/dailyTask',
				'component' => 'DailyTask',
				'name' => '每日任务',
				'hidden' => false,
				'pageId' => 3103,
				'authority'=>array(
					"dailyTasks_get"=>'read',
					"dailyTasks_delete"=>'delete',
					"dailyTasks_put"=>'edit',
					"dailyTasks_post"=>'add',
					),	
			),
			array(
				'path' => '/loginAward',
				'component' => 'LoginAward',
				'name' => '登录奖励',
				'hidden' => false,	
				'pageId' => 3104,
				'authority'=>array(
					"loginAwards_get"=>'read',
					),
			),	
			array(
				'path' => '/loginTask',
				'component' => 'LoginTask',
				'name' => '登录任务',
				'hidden' => false,	
				'pageId' => 3105,
				'authority'=>array(
					"loginTasks_get"=>'read',
					),
			),
			array(
				'path' => '/activity',
				'component' => 'Activity',
				'name' => '公告活动',
				'hidden' => false,	
				'pageId' => 3106,
				'authority'=>array(
					"activity_get"=>'read',
					"activity_post"=>'add',
					'activity_put'=>'edit',
					'activity_delete'=>'delete',
					),
			),
			array(
				'path' => '/rolette',
				'component' => 'Rolette',
				'name' => '大转盘',
				'hidden' => false,	
				'pageId' => 3107,
				'authority'=>array(
					"rolettes_get"=>'read',
					"rolettes_post"=>'add',
					'rolettes_put'=>'edit',
					'rolettes_delete'=>'delete',
					),
			)	
		)
	),
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '商城配置',
		'iconCls' => 'fa fa-shopping-cart',
		'children' => array(
			array(
				'path' => '/goods',
				'component' => 'Goods',
				'name' => '商品配置',
				'hidden' => false,	
				'pageId' => 3201,
				'authority'=>array(
					"goods_vipget"=>'read',
					"goods_get"=>'read',
					'goods_vipdelete'=>'delete',
					'goods_put'=>'edit',
					"goods_vippost"=>'add',
					"goods_post"=>'add',
					),
			)
		)
	),
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '用户管理',
		'iconCls' => 'fa fa-users',
		'children' => array(
			array(
				'path' => '/user',
				'component' => 'User',
				'name' => '用户管理',
				'hidden' => false,	
				'pageId' => 4001,
				'authority'=>array(
					"users_get"=>'read',
					),
			),
			array(
				'path' => '/order',
				'component' => 'Order',
				'name' => '用户订单管理',
				'hidden' => false,	
				'pageId' => 4002,
				'authority'=>array(
					"orders_get"=>'read',
					),
			),
			array(
				'path' => '/mail',
				'component' => 'Mail',
				'name' => '邮件管理',
				'hidden' => false,
				'pageId' => 4101,
				'authority'=>array(
					"mails_get"=>'read',
					"mails_post"=>'add',
					"mailgoods_post"=>'add',
					'mails_put'=>'edit',
					'mail_delete'=>'delete',
					),	
			),
			array(
				'path' => '/mailLog',
				'component' => 'MailLog',
				'name' => '邮件记录查询',
				'hidden' => false,	
				'pageId' => 4102,
				'authority'=>array(
					"mailLogs_get"=>'read',
				),
			)							
		)
	),
	array(
		'path' => '/',
		'component' => 'Home',
		'name' => '代理管理',
		'iconCls' => 'fa fa-users',
		'children' => array(
			array(
				'path' => '/agentSettings',
				'component' => 'AgentSettings',
				'name' => '代理设置',
				'hidden' => false,	
				'pageId' => 5000
			),
			array(
				'path' => '/agent',
				'component' => 'Agent',
				'name' => '代理管理',
				'hidden' => false,	
				'pageId' => 5001,
				'authority'=>array(
					"agents_get"=>'read',
					"myAgents_get"=>'read',
					/*'verify'=>'edit',*/
					'disable'=>'edit',
					'able'=>'edit',
					),
			),
			array(
				'path' => '/userRecharge',
				'component' => 'UserRecharge',
				'name' => '转账记录【玩家】',
				'hidden' => false,	
				'pageId' => 5002,
				'authority'=>array(
					"userRecharges_get"=>'read',
					),
			),
			array(
				'path' => '/agentRecharge',
				'component' => 'AgentRecharge',
				'name' => '转账记录【代理】',
				'hidden' => false,	
				'pageId' => 5003,
				'authority'=>array(
					"agentRecharges_get"=>'read',
					),
			),
			array(
				'path' => '/agentOrder',
				'component' => 'AgentOrder',
				'name' => '购买记录',
				'hidden' => false,	
				'pageId' => 5004,
				'authority'=>array(
					"agentOrders_get"=>'read',
					),
			),
			array(
				'path' => '/agentRebate',
				'component' => 'AgentRebate',
				'name' => '返利详情',
				'hidden' => false,	
				'pageId' => 5005,
				'authority'=>array(
					"agentRebates_get"=>'read',
					),
			),
			array(
				'path' => '/agentPackage',
				'component' => 'AgentPackage',
				'name' => '套餐设置',
				'hidden' => false,	
				'pageId' => 5006,
				'authority'=>array(
					"agentPackages_get"=>'read',
					'agentPackages_delete'=>'delete',
					'agentPackages_put'=>'edit',
					'disable'=>'edit',
					'able'=>'edit',
					"agentPackages_post"=>'add',
					),
			)									
		)
	) 	  
);


