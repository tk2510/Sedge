<?php

require_once('__conn.php'); // 连接数据库

/* 更新
	$table为表名 , $para 为set的参数, $where为where条件
	(多条set语句用,隔开)
	返回布尔值,true：更新成功， false更新失败
*/
function update($table, $para, $where)
{
	$set = '';
	$flag = false;
	foreach($para as $key=>$value){
		if($flag)  $set .= ' , ';
		$flag = true;
		$set .= $key . "='" . $value . "'";		
	}
	$str = 'UPDATE ' . $table . ' SET ' . $set . ' WHERE ' . $where;
	echo $str;
	return write_db($str);
}



/*
$wdscp = 'Stevie Hoang is a big cow!';
$wid = '2';

$para["wdscp"] = $wdscp;
$para["name"] = "123467";


update('whuwork', $para, "wid='$wid'");
*/

?>
