<?php
/*
Author: Ng1091
Date: 2014-02-24
Description: 本地化文件 zh-cn 简体中文
*/

$lang -> field_name -> user_login		= '邮箱';
$lang -> field_name -> ID				= 'ID';
$lang -> field_name -> data				= '数据';

$lang -> field_name -> is_id			= 'ID';
$lang -> field_name -> is_ID			= 'ID';
$lang -> field_name -> is_ip			= 'IP';
$lang -> field_name -> is_qq			= 'QQ';


$lang -> checker -> index				= '首页';
$lang -> checker -> fatal_error			= '系统错误：Checker中的内部函数不存在';
$lang -> checker -> fatal_error2		= '系统错误：Checker中的自定义内部函数不存在';
$lang -> checker -> checker_len			= '%s的长度不符合要求，应为%d到%d';
$lang -> checker -> checker_size		= '%s的大小不符合要求，应为%d到%d';
$lang -> checker -> preg_error			= '%s的格式不符合要求';



class Lang
{
	public static function checker_len($name, $low, $high)
	{
		$err = $name . '的长度不符合要求，应为' . $low . '到' . $high;
		// echo $err;
		return $err;
	}
	
	public static function preg_error($name)
	{
		$err = $name . '的格式不符合要求';
		// echo $err;
		return $err;
	}

}



?>