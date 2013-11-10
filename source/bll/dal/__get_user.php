<?php
/*
Author: ng1091
Date: 2013-11-09
Description: 取得一条用户记录
*/

include('__select.php');


/*
	根据用户ID查找user表，返回该用户记录
	$id 为用户ID
	返回用户记录的数组，或false表示未找到
*/
function get_user_by_id($id)
{
	$res = select('*','ng_user',"ID='$id' limit 1");
	return mysql_fetch_array($res);
}


/*
	根据用户邮箱查找user表，返回该用户记录
	$login 为用户邮箱
	返回用户记录的数组，或false表示未找到
*/
function get_user_by_login($login)
{
	$res = select('*','ng_user',"user_login='$login' limit 1");
	return mysql_fetch_array($res);	
}


/*
	根据用户学号查找user表，返回该用户记录
	$stuid 为用户学号
	返回用户记录的数组，或false表示未找到
	* 注意学号是varchar型，传入别忘了加引号
*/
function get_user_by_stuid($stuid)
{
	$res = select('*','ng_user',"user_stuid='$stuid' limit 1");
	return mysql_fetch_array($res);	
}


/* test case
echo '<br>get_user_by_id';
$arr = get_user_by_id(2);
var_dump($arr);

$arr = get_user_by_id(12);
if($arr == false) echo '<br>not found';
else var_dump($arr);

echo '<br>get_user_by_login';
var_dump(get_user_by_login("weitao201@163.com"));

echo '<br>get_user_by_stuid';
var_dump(get_user_by_stuid('2011301500699'));
*/

?>

