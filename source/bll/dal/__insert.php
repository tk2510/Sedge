<?php

include('conn.php'); // 连接数据库

/* 
    插入一条记录
	$para为key-value数组，key属性名，value为值
	$talbe 为表名
	返回执行结果
*/
function insert($para, $table)
{
	
	$str = 'INSERT INTO ' . $table . '(';
	$val = '';
	$flag = false;
	
	foreach($para as $key=>$value){
		if($flag)  {
			$str .= ',';
			$val .= ',';
		}
		$flag = true;
		
		$str .= $key;
		$val .= "'$value'";
	}
	$str .= ')';
	$val .= ')';
	
	$str .= 'VALUES(' . $val; // 最终的sql语句
	// echo $str; 
	return write_db($str);
}

/*
// Test Case:
$array = array(
	"username" => "weitao201",
	"password" => "assssssss",
	"email" => "weitao201@163.com",
	"regdate" => 123123,
	"name" => "ng1091",
);


if(insert($array, 'whuuser'))
{
	echo 'insert ok!';
}
else
{
	echo 'insert failed';
}
*/


?>

