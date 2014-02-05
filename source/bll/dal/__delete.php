<?php

require_once('__conn.php'); // 连接数据库

/* 删除
	$from为from条件， $where为where及其它条件
	返回删除结果
*/
function delete($from, $where)
{
	$str = 'DELETE FROM ' . $from . ' WHERE ' . $where;
	echo $str;
	return write_db($str);
}

?>