<?php

include('__conn.php'); // 连接数据库

/* 更新
	$table为表名 , $para 为set的参数, $where为where条件
	(多条set语句用,隔开)
	返回执行结果
*/
function update($table, $set, $where)
{
	$str = 'UPDATE ' . $table . ' SET ' . $set . ' WHERE ' . $where;
	echo $str;
	return write_db($str);
}


/*
// $sql = "update whuwork set wdscp='$wdscp' where wid='$wid'";

$wdscp = 'Stevie Hoang is a big cow!';
$wid = '2';

update('whuwork', "wdscp='$wdscp'", "wid='$wid'");
*/

?>
