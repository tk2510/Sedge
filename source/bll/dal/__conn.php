<?php
/*****************************
*数据库连接
*****************************/

function write_db($sql)
{
	$conn = mysql_connect("localhost","sedgeadmin","sedge123","sedgeadmin");
	if (!$conn)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("sedge", $conn);

	// echo '<br>' . $sql; // 显示sql语句
	
	return mysql_query($sql,$conn);// 写入数据库
}

?>
