<?php

include('__conn.php'); // 连接数据库

/* 查询
	$sel为select条件，$from为from条件， $where为where及其它条件
	返回查询结果array
*/
function select($sel, $from, $where)
{
	$str = 'SELECT ' . $sel . ' FROM ' . $from . ' WHERE ' . $where;
	// echo $str;
	return write_db($str);
}


/*
$username = 'weitao201';
$password = 'assssssss';
$res = select('uid','whuuser',"username='$username' and password = '$password' limit 1");

while($row = mysql_fetch_array($res))
{
	echo '<br>';
	print_r($row);
}

// echo $res;
*/


?>