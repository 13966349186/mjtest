<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** 公用函数 */
if(!function_exists('expToLev')){
	/** 根据经验计算等级 */
	function expToLev($exp) {
		$lev = 0;
		$CI = &get_instance();
		$lev_cfg = $CI->config->item('lev_exp');
		foreach ($lev_cfg as $need_exp){
			if($exp < $need_exp){break;}
			$lev++;
		}
		return $lev;
	}
}

if(!function_exists('getDayStart')){
	/** 根据指定时间获取当前时区所处天的零点时刻 */
	function getDayStart($time){
		return strtotime(date('Y-m-d 00:00:00', $time));
	}
}
if(!function_exists('getDayKey')){
	/** 根据指定时间所在天生成键 */
	function getDayKey($time){
		return (int)( ($time - strtotime('1970-01-05 00:00:00') )/ 86400 );
	}
}
if(!function_exists('getWeekKey')){
	/** 根据指定时间所在周生成键 */
	function getWeekKey($time){
		return (int)( ($time - strtotime('1970-01-05 00:00:00') )/(7*86400));
	}
}
if(!function_exists('createRandChar')){
	/**
	 * 生成随机串
	 * @param integer $len 长度
	 * @param varaint $max_len 最大长度
	 * @param varaint $firstLimit 是数字时,1表示返回内容不能以0开头， 2表示返回内容不能以数字开头， 3表示只能以大写字母开头； 是字符串时,表示返回内容开头字母只能在限定的字符串中
	 * @param string $char 字符集范围
	 */
	function createRandChar($len, $max_len=null, $firstLimit=false, $char=null){
		$len = (int)$len;
		if(is_int($max_len) && $max_len != $len){
			$len += $max_len>$len?rand(0, $max_len-$len):-rand(0, $len-$max_len);
		}
		//===========限制数量，防止误传过大的参数时间超长================
		if($len < 1 || $len > 1024000){ return '';}
		$firstChars = '';
		if(!is_string($char) || strlen($char) < 1){$char = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';}
		if(is_string($firstLimit) && strlen($firstLimit) > 0){
			$firstChars = $firstLimit;
		}else if(is_int($firstLimit)){
			for($i=0;$i<strlen($char);$i++){
				if($firstLimit === 3 && ord($char[$i]) >= ord('A') && ord($char[$i]) <= ord('Z')){
					$firstChars .= $char[$i];//以大写字母开头
				}else if($firstLimit === 2 && !(ord($char[$i]) <= ord('9') && ord($char[$i]) >= ord('0'))){
					$firstChars .= $char[$i];//不以数字开头
				}else if($firstLimit === 1 && ord($char[$i]) != ord('0')){
					$firstChars .= $char[$i];//不以0开头
				}
			}
		}else{
			$firstChars = $char;
		}
		if(strlen($firstChars) < 1){ return '';}
		$rtn = $firstChars[rand(0, strlen($firstChars)-1)];;
		for($i=1;$i<$len;$i++){
			$rtn .= $char[rand(0, strlen($char)-1)];
		}
		return $rtn;
	}
}

if(!function_exists('get_weeks')){
	function get_weeks($start, $end) { 
		$startDate = date('Y-m-d', $start);
		$endDate = date('Y-m-d', $end);
		//跨越天数
		$n = (strtotime($endDate)-strtotime($startDate))/86400;
		//结束时间加一天(sql语句里用的是小于和大于，如果有等于的话这句可以不要)
		$endDate = date("Y-m-d 00:00:00",strtotime("$endDate +1 day"));
		//判断，跨度小于7天，可能是同一周，也可能是两周
		if($n<7){
		    //查开始时间 在 那周 的 位置
		    $day            = date("w",strtotime($startDate))-1;
		    //查开始时间  那周 的 周一
		    $week_start        = date("Y-m-d 00:00:00",strtotime("$startDate -{$day} day"));
		    //查开始时间  那周 的 周末
		    $day            = 7-$day;
		    $week_end        = date("Y-m-d 00:00:00",strtotime("$startDate +{$day} day"));
		    //判断周末时间是否大于时间段的结束时间，如果大于，那就是时间段在同一周，否则时间段跨两周
		    if($week_end>=$endDate){        
		        $weekList[] =array($startDate,$endDate);
		    }else{
		        $weekList[] =array($startDate,$week_end);        
		        $weekList[] =array($week_end,$endDate);    
		    }
		}else{
		    //如果跨度大于等于7天，可能是刚好1周或跨2周或跨N周，先找出开始时间 在 那周 的 位置和那周的周末时间
		    $day         = date("w",strtotime($startDate))-1;
		    $week_start  = date("Y-m-d 00:00:00",strtotime("$startDate -{$day} day"));
		    $day         = 7-$day;
		    $week_end    = date("Y-m-d 00:00:00",strtotime("$startDate +{$day} day"));
		    //先把开始时间那周写入数组
		    $weekList[]  =array($startDate,$week_end); 
		    //判断周末是否大于等于结束时间，不管大于(2周)还是等于(1周)，结束时间都是时间段的结束时间。
		    if($week_end >= $endDate){
		        $weekList[] = array($week_end,$endDate);
		    }else{
		       //N周的情况用while循环一下，然后写入数组
		        while($week_end <= $endDate){
		            $start         = $week_end;
		            $week_end    = date("Y-m-d 00:00:00",strtotime("$week_end +7 day"));
		            if($week_end <= $endDate){
		                $weekList[]  = array($start,$week_end);
		            }else{
		                $weekList[]  = array($start,$endDate);
		            }
		        }
		    }
		}
		return $weekList;
	}
}

if(!function_exists('get_months')){

  /**
  * 获取指定日期之间的各个月
  */
/** 
* 生成从开始月份到结束月份的月份数组
* @param int $start 开始时间戳
* @param int $end 结束时间戳
*/ 
function get_months($start,$end){
	if(!is_numeric($start)||!is_numeric($end)||($end<=$start)) return '';
	$start=date('Y-m',$start);
	$end=date('Y-m',$end);
	//转为时间戳
	$start=strtotime($start.'-01');
	$end=strtotime($end.'-01');
	$i=0;
	$d=array();
	while($start<=$end){
		//这里累加每个月的的总秒数 计算公式：上一月1号的时间戳秒数减去当前月的时间戳秒数

		$start1 = $start + strtotime('+1 month',$start)-$start;
		$d[]=array(
			'start' => date('Y/m/d', strtotime(date('Y-m',$start))),
			'end' => date('Y/m/d', $start1)
		);
		$start = $start1;

		$i++;
	} 
	return $d;
}


}