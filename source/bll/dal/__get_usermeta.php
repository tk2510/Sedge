<?php
/*
Author: ng1091
Date: 2013-11-10
Description: 取得一条用户meta
*/

include('__select.php');


/*
	根据meta_id查找usermeta表，返回该条记录
	$id 为meta_id
	返回用户记录的数组，或false表示未找到
*/
function get_usermeta_by_id($meta_id)
{
	$res = select('*','ng_usermeta',"meta_id='$meta_id' limit 1");
	return mysql_fetch_array($res);
}


/*
	根据用户ID查找usermeta表，返回该用户的所有meta记录
	$id 为用户ID
	返回找到的所有记录，装在数组中，因为记录条数可能不止一条，所以需要使用mysql_fetch_array函数，用法如下：
	while($temp = mysql_fetch_array($res))
	{
		// 每循环一次，得到一条记录
		// some codes
	}
	
	
	若返回false表示未找到
*/
function get_usermeta_by_userid($user_id)
{
	$res = select('*','ng_usermeta',"user_id='$user_id'");
	return $res;
}


/*
	根据用户ID和meta_key查找usermeta表，返回该条记录
	$user_id 为用户ID，$meta_key
	返回用户记录的数组，或false表示未找到
*/
function get_usermeta($user_id, $meta_key)
{
	$res = select('*','ng_usermeta',"user_id='$user_id' and meta_key='$meta_key'");
	return mysql_fetch_array($res);
}




/* test case
echo 'get_usermeta_by_id<br>';
var_dump(get_usermeta_by_id(1));

echo '<br>get_usermeta_by_userid<br>';
$arr = get_usermeta_by_userid(2);
while($temp = mysql_fetch_array($arr))
{
	var_dump($temp);
}

echo '<br>get_usermeta<br>';

var_dump(get_usermeta(3,"个性签名"));
*/

?>

