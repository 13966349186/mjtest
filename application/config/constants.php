<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

define('DELETEPOWER', 8); //0x1000
define('ADDPOWER', 4); //0x1000
define('EDITPOWER', 2); //0x0100
define('VIEWPOWER', 1);//0x0010

define('DELETED',1);
define('UNDELETED',0);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('SYSLOG_DEFAULT_IDENT', 'QIPAI');
define('CS_LOG_TENCENT_ERR', 'tencent_error');
define('CS_LOG_TENCENT_BILLS', 'tencent_bills');
define('CS_LOG_TENCENT_NOTIFY', 'tencent_notify');

/** 物品类型：金币 */
define('GOODS_GOLD', 1);
/** 物品类型：钻石 */
define('GOODS_POINT', 2);
/** 物品类型：房卡 */
define('GOODS_CARD', 3);
/** 物品类型：大转盘次数 */
define('GOODS_ROLETTE', 4);
/** 物品类型：表情包 */
define('GOODS_EMOJI', 5);
/** 物品类型：VIP */
//define('GOODS_VIP', 6);

/** 任务分组：登录任务 */
define('TASK_GROUP_LOGIN', 201);
/** 任务分组：日常任务 */
define('TASK_GROUP_DALIY', 202);
/** 任务分组：活动任务 */
define('TASK_GROUP_ACTIVITY', 203);

/** 奖励组：登录抽奖 */
define('POND_GROUP_LOGIN', 101);
/** 奖励组：大转盘抽奖 */
define('POND_GROUP_ROLETTE', 102);

/** 任务条件：[总计]累计登录天数 */
define('COND_LOGIN_DAYS', 1);
/** 任务条件：[总计]连续登录天数 */
define('COND_LOGIN_SERIAL_DAYS', 2);


/** 任务条件：[总计]金币数量 */
define('COND_TOTAL_GOLD_NUM', 3);
/** 任务条件：[总计]经验值 */
//define('COND_EXP', 4);
/** 任务条件：[总计]经典场-游戏局数 */
define('COND_RANDOM_PALY', 5);
/** 任务条件：[总计]经典场-胜利局数 */
define('COND_RANDOM_WIN', 6);
/** 任务条件：[总计]经典场-连胜局数 */
define('COND_RANDOM_SERIAL_WIN', 7);
/** 任务条件：[总计]好友同玩-游戏局数 */
define('COND_ROOM_PALY', 8);
/** 任务条件：[总计]好友同玩-胜利局数 */
define('COND_ROOM_WIN', 9);
/** 任务条件：[总计]好友同玩-连胜局数 */
define('COND_ROOM_SERIAL_WIN', 10);
/** 任务条件：[总计]好友同玩-参加房间次数 */
define('COND_ROOM_JOIN', 11);
/** 任务条件：[总计]好友同玩-创建房间次数 */
define('COND_ROOM_CREATE', 12);
/** 任务条件：[总计]好友同玩-当前连胜局数 */
define('COND_ROOM_CUR_SERIAL_WIN', 13);
/** 任务条件：[总计]经典场-当前连胜局数 */
define('COND_RANDOM_CUR_SERIAL_WIN', 14);
/** 任务条件：[总计]用户金币数量 */
define('COND_USER_GOLD_NUM', 15);
/** 任务条件：[总计]用户经验值 */
define('COND_USER_EXP_NUM', 16);
/** 任务条件：[总计]用户钻石数量 */
define('COND_USER_POINT_NUM', 17);
/** 任务条件：[总计]用户房卡数量 */
define('COND_USER_CARD_NUM', 18);
/** 任务条件：[每日]赢取金币总计 */
define('COND_DAILY_WIN_GOLD', 101);
/** 任务条件：[每日]经典场-游戏局数 */
define('COND_DAILY_RANDOM_PALY', 102);
/** 任务条件：[每日]经典场-胜利局数 */
define('COND_DAILY_RANDOM_WIN', 103);
/** 任务条件：[每日]经典场-连胜局数 */
define('COND_DAILY_RANDOM_SERIAL_WIN', 104);
/** 任务条件：[每日]好友同玩-游戏局数 */
define('COND_DAILY_ROOM_PALY', 105);
/** 任务条件：[每日]好友同玩-胜利局数 */
define('COND_DAILY_ROOM_WIN', 106);
/** 任务条件：[每日]好友同玩-连胜局数 */
define('COND_DAILY_ROOM_SERIAL_WIN', 107);
/** 任务条件：[每日]好友同玩-参加房间次数 */
define('COND_DAILY_ROOM_JOIN', 108);
/** 任务条件：[每日]好友同玩-创建房间次数 */
define('COND_DAILY_ROOM_CREATE', 109);
/** 任务条件：[每周]游戏局数 */
define('COND_WEEKLY_RANDOM_PALY', 201);
/** 任务条件：[每周]胜利局数 */
define('COND_WEEKLY_RANDOM_WIN', 202);

/** 任务条件：[总计]最大金币数 */
define('COND_MAX_GOLD_NUM', 19);
/** 任务条件：[每周]获取金币总量 */
define('COND_WEEKLY_WIN_GOLD', 201);
/** 任务条件： 掼蛋-[总计]经典场-游戏局数*/
define('COND_GD_RANDOM_PALY', 1001);
/** 任务条件： 掼蛋-[总计]经典场-胜利局数*/
define('COND_GD_RANDOM_WIN', 1002);
/** 任务条件：掼蛋-[总计]经典场-连胜局数 */
define('COND_GD_RANDOM_COMBO', 1003);
/** 任务条件： 掼蛋-[总计]经典场-最大连胜局数*/
define('COND_GD_RANDOM_MAX_COMBO', 1004);
/** 任务条件： 掼蛋-[总计]经典场-双上次数*/
define('COND_GD_RANDOM_DOUBLE', 1005);
/** 任务条件： 掼蛋-[每日]经典场-游戏局数*/
define('COND_GD_DAILY_RANDOM_PALY', 1101);
/** 任务条件： 掼蛋-[每日]经典场-胜利局数*/
define('COND_GD_DAILY_RANDOM_WIN', 1102);
/** 任务条件： 掼蛋-[每日]经典场-连胜局数*/
define('COND_GD_DAILY_RANDOM_COMBO', 1103);
/** 任务条件： 掼蛋-[每日]经典场-最大连胜局数*/
define('COND_GD_DAILY_RANDOM_MAX_COMBO', 1104);
/** 任务条件： 掼蛋-[每日]经典场-双上次数*/
define('COND_GD_DAILY_RANDOM_DOUBLE', 1105);

