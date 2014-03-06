<?php
/*
Author: Ng1091
Date: 2014-02-24
Description: 数据验证类
*/

require_once(dirname(dirname(__FILE__)) . '/lang/zh-cn.php');
require_once(dirname(__FILE__) . '/__conn.php');


$checker -> is_id -> func = array('is_id');
$checker -> is_ID -> func = array('is_id');
$checker -> is_post_id -> func = array('is_id');
$checker -> is_user_id -> func = array('is_id');
$checker -> is_class_id -> func = array('is_id');
$checker -> is_user_pass -> len = array(6,16);
$checker -> is_user_pass -> func = array('is_text');
$checker -> is_user_login -> len = array(1,100);
$checker -> is_user_login -> func = array('is_email');
$checker -> is_user_school -> len = array(1,10);
$checker -> is_user_school -> func = array('is_alphanum');
$checker -> is_user_stuid -> len = array(5,50);
$checker -> is_user_stuid -> func = array('is_num');
$checker -> is_user_nickname -> len = array(2,24);
$checker -> is_user_nickname -> func = array('is_cn_alphanum');
$checker -> is_user_name -> len = array(2,24);
$checker -> is_user_name -> func = array('is_cn');
$checker -> is_user_gender -> len = array(1,1);
$checker -> is_user_gender -> func = array('is_int');
$checker -> is_class_name -> len = array(1,100);
$checker -> is_class_name -> func = array('is_cn_alphanum');
$checker -> is_class_subhead -> len = array(1,100);
$checker -> is_class_subhead -> func = array('is_cn_alphanum');
$checker -> is_class_content -> len = array(1,65536);
$checker -> is_class_content -> func = array('no_html','is_cn_text');
$checker -> is_class_parent -> func = array('is_id');
$checker -> is_class_level -> func = array('is_id');
$checker -> is_class_status -> func = array('is_id');
$checker -> is_class_user_IP -> func = array('is_ip','ip2int');
$checker -> is_comment_id -> func = array('is_id');
$checker -> is_comment_post_id -> func = array('is_id');
$checker -> is_comment_user_id -> func = array('is_id');
$checker -> is_comment_parent -> func = array('is_id');
$checker -> is_log_id -> func = array('is_id');
$checker -> is_login_user -> func = array('is_id');
$checker -> is_login_IP -> func = array('is_ip','ip2int');
$checker -> is_login_agent -> len = array(1,255);
$checker -> is_login_agent -> func = array('no_html','is_cn_text');
$checker -> is_post_user -> func = array('is_id');
$checker -> is_post_class -> func = array('is_id');
$checker -> is_post_deadline -> len = array(10,19);
$checker -> is_post_deadline -> func = array('is_date','date_to_stamp');
$checker -> is_post_status -> func = array('is_id');
$checker -> is_comment_status -> func = array('is_id');
$checker -> is_post_parent -> func = array('is_id');
$checker -> is_post_size -> func = array('is_id');
$checker -> is_post_visible -> func = array('is_id');
$checker -> is_post_type -> len = array(1,255);
$checker -> is_post_type -> func = array('is_cn_text');
$checker -> is_post_title -> len = array(1,255);
$checker -> is_post_title -> func = array('no_html','is_cn_text');
$checker -> is_post_subhead -> len = array(1,255);
$checker -> is_post_subhead -> func = array('no_html','is_cn_text');
$checker -> is_post_password -> len = array(6,16);
$checker -> is_post_password -> func = array('is_text');
$checker -> is_post_content -> len = array(1,65536);
$checker -> is_post_content -> func = array('no_html','is_cn_text');
$checker -> is_comment_content -> len = array(1,4096);
$checker -> is_comment_content -> func = array('no_html','is_cn_text');
$checker -> is_submit_IP -> func = array('is_ip','ip2int');
$checker -> is_status -> func = array('is_id');
$checker -> is_meta_id -> func = array('is_id');
$checker -> is_meta_key -> len = array(1,255);
$checker -> is_meta_key -> func = array('is_alphanum');
$checker -> is_meta_value -> len = array(1,65536);
$checker -> is_meta_value -> func = array('no_html','is_cn_text');
$checker -> is_option_id -> func = array('is_id');
$checker -> is_option_key -> len = array(1,255);
$checker -> is_option_key -> func = array('is_alphanum');
$checker -> is_option_value -> len = array(1,65536);
$checker -> is_option_value -> func = array('no_html','is_cn_text');
$checker -> is_IP -> func = array('is_ip','ip2int');
$checker -> is_ip -> func = array('is_ip','ip2int');


class Checker
{
	private $low;   // lower limit of value
	private $high;  // upper limit of value
	private $len_low;  // lower limit of length
	private $len_high; // upper limit of length
	private $preg;   // regular expression (string or array)
	private $info; // error information
	
	private function check_size($data, $low, $high)
	{
		return ($low <= $data && $data <= $high) ? true : false;
	}
	
	private function check_len($data, $low, $high)
	{
		$len = strlen($data);
		return ($low <= $len && $len <= $high) ? true : false;
	}
	
	private function date_to_stamp(& $date) // parameter must be variable (can't be const)
	{
		$date = strtotime($date);
		return true;
	}
	
	private function ip2int(& $ip) // parameter must be variable (can't be const)
	{
		$ip = bindec(decbin(ip2long($ip)));
		return true;
	}

	function anti_sql_inject(& $data)
	{
		if(get_magic_quotes_gpc()) $data = stripslashes($data);
		$data = mysql_real_escape_string($data, write_db(false));
	}
	
	private function is_pint($data) // positive integer
	{
		return preg_match('/^[1-9]\d*$/', $data) == 1;
	}	
	
	private function is_nnint($data) // nonnegative integer
	{
		return preg_match('/^[1-9]\d*$|^0$/', $data) == 1;
	}
	
	private function is_nint($data) // negative integer
	{
		return preg_match('/^(-[1-9]\d*)$/', $data) == 1;
	}
	
	private function is_npint($data) // non positive integer
	{
		return preg_match('/^(-[1-9]\d*)$|^(0)$/', $data) == 1;
	}
	
	private function is_int($data) //  integer
	{
		return preg_match('/^-?[1-9]\d*$|^0$/', $data) == 1;
	}
	
	private function is_num($data) //  number   0~9
	{
		return preg_match('/^\d+$/', $data) == 1;
	}
	
	private function is_pfloat($data) //  positive float
	{
		return preg_match('/(^[1-9]\d*(\.\d+)?$)|(^0\.0*[1-9]\d*$)/', $data) == 1;
	}
	
	private function is_nnfloat($data) //  nonnegative float
	{
		return preg_match('/(^[1-9]\d*(\.\d+)?$)|(^0(\.\d+)?$)/', $data) == 1;
	}
	
	private function is_nfloat($data) //  negative float
	{
		return preg_match('/(^-[1-9]\d*(\.\d+)?$)|(^-0\.0*[1-9]\d*$)/', $data) == 1;
	}
	
	private function is_npfloat($data) //  non positive float
	{
		return preg_match('/(^-[1-9]\d*(\.\d+)?$)|(^-0\.[1-9]\d*$)|(^-?0(\.0+)?$)/', $data) == 1;
	}
	
	private function is_float($data) // float
	{
		return preg_match('/(^-?[1-9]\d*(\.\d+)?$)|(^-?0\.0*[1-9]\d*$)|(^-?0(\.0+)?$)/', $data) == 1;
	}
	
	private function is_alpha($data) // alphabet
	{
		return preg_match('/^[A-Za-z_]+$/', $data) == 1;
	}
	
	private function is_alphanum($data) // alphabet and numeric
	{
		return preg_match('/^[A-Za-z0-9_]+$/', $data) == 1;
	}
	
	private function is_cn($data) // chinese
	{
		return preg_match('/^([^\x00-\xff]|_)+$/', $data) == 1;
	}
	
	private function is_cn_alphanum($data) // chinese , alphabet and numeric
	{
		return preg_match('/^([A-Za-z0-9_]|[^\x00-\xff])+$/', $data) == 1;
	}
	
	private function is_text($data) // ascii without special char
	{
		return preg_match('/^([\x09\x0a\x0d\x20-\x7e])+$/', $data) == 1;
	}
	
	private function is_cn_text($data) // no special char
	{
		return preg_match('/^([\x09\x0a\x0d\x20-\x7e]|[^\x00-\xff])+$/', $data) == 1;
	}
	
	private function no_html($data) // no html tag
	{
		return preg_match('/<(.*)>.*<\/\1>|<(.*) \/>/', $data) == 0;
	}
	
	private function is_email($data) // email address
	{
		return preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/', $data) == 1;
	}
	
	private function is_qq($data) // qq number
	{
		return preg_match('/^[1-9]+[0-9]*$/', $data) == 1;
	}
	
	private function is_ip($data) // ipv4 address
	{
		return preg_match('/^(([0-1])?\d{1,2}|2[0-4]\d|25[0-5])(\.(([0-1])?\d{1,2}|2[0-4]\d|25[0-5])){3}$/', $data) == 1;
	}
	
	private function is_id($data) 
	{
		return $this -> check_len($data, 1, 11) && $this -> is_pint($data);
	}
	
	private function is_date($data) // YYYY-MM-DD hh:mm:ss(include leap year)
	{
		return preg_match('/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)( (0\d|1\d|2[0-3]):[0-5]\d(:[0-5]\d)?)?$/', $data) == 1;
	}
	
	
	/* public methods */
	
	public function set_size($low, $high)
	{
		$this -> low = $low;
		$this -> high = $high;
	}
	
	public function set_len($low, $high)
	{
		$this -> len_low = $low;
		$this -> len_high = $high;
	}
	
	public function set_pattern($preg)
	{
		$this -> preg = $preg;
	}
	
	public function clear()
	{
		$this -> low = $this -> high = $this -> len_low = $this -> len_high = $this -> preg = NULL;
	}
	
	public function show()
	{
		echo $this -> low, ' ' , $this -> high, ' ' , $this -> len_low , ' ' , $this -> len_high , ' ' , $this -> preg;
	}
	
	public function info()
	{
		return $this -> info;
	}
	
	
	public function check(& $data, $func = false, $len_low = 0, $len_high = 0) // auto check , the first parameter must be variable (can't be const)
	{
		global $checker;
		global $lang;

		if(is_array($data))
		{
			foreach($data as $key => & $value)
			{
				// if(get_magic_quotes_gpc()) $value = stripslashes($value);
				// $value = mysql_real_escape_string($value, write_db(false));
				$this -> anti_sql_inject($value);

				$name = 'is_' . $key;
				echo 'func name: ' , $name , ' ';
				
				if(isset($checker -> $name)) 
				{
					echo 'exist ';
					if(isset($checker -> $name -> len)) // check length
					{
						// echo 'len ';
						// echo $checker -> $name -> len[0] , ' ';
						// echo $checker -> $name -> len[1];
						// echo $value;
						$low  = $checker -> $name -> len[0];
						$high = $checker -> $name -> len[1];
						if(!$this -> check_len(& $value, $checker -> $name -> len[0], $checker -> $name -> len[1]))
						{
							$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $key, $low, $high);
							unset($value); 
							unset($checker); 
							unset($lang);  
							return false;
						}
					}
					
					if(isset($checker -> $name -> func))  // check pattern
					{
						echo 'func ';
						foreach($checker -> $name -> func as $func_name)
						{
							echo $func_name , ' ';;
							if(method_exists($this,$func_name))
							{
								// echo 'func found';
								if(!$this -> $func_name(& $value))
								{
									// echo 'faild';
									$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $func_name);
									unset($value); 
									unset($checker);  
									unset($func_name);
									unset($lang);   
									return false;
								}
							}
							else
							{
								$this -> info = $lang -> checker -> fatal_error;
								unset($value); 
								unset($checker);   
								unset($lang);  
								return false;
							}
						}
						unset($func_name);
					}
				}
				else if(method_exists($this, $key))
				{
					echo $key , ' method exist ';
					if($len_low || $len_high)
					{
						if(!$this -> check_len(& $value, $len_low, $len_high))
						{
							$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $key, $len_low, $len_high);
							unset($value); 
							unset($checker); 
							unset($lang);  
							return false;
						}
					}
					
					if(!$this -> $key(& $value))
					{
						$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $key);
						unset($value); 
						unset($checker);   
						unset($lang);  
						return false;
					}
				}
				else if($func)
				{
					echo 'func exist ' , $func;
					if(method_exists($this,$func))
					{
						if($len_low || $len_high)
						{
							if(!$this -> check_len(& $value, $len_low, $len_high))
							{
								$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $func, $len_low, $len_high);
								unset($value); 
								unset($checker); 
								unset($lang);  
								return false;
							}
						}
					
						if(!$this -> $func(& $value))
						{
							$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $func);
							unset($value); 
							unset($checker);   
							unset($lang);  
							return false;
						}
					}
					else
					{
						$this -> info = $lang -> checker -> fatal_error2;
						unset($value); 
						unset($checker);   
						unset($lang);  
						return false;
					}
				}
				else return false; // 没有指定func
				echo  '<br/>';
			}
			unset($value);
		}
		else if($func)
		{
			echo 'entry else if';
			if(method_exists($this, $func))
			{
				// if(get_magic_quotes_gpc()) $data = stripslashes($data);
				// $data = mysql_real_escape_string($data, write_db(false));
				$this -> anti_sql_inject($data);
				
				if($len_low || $len_high)
				{
					if(!$this -> check_len(& $data, $len_low, $len_high))
					{
						$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $func, $len_low, $len_high);
						unset($value); 
						unset($checker); 
						unset($lang);   
						return false;
					}
				}
			
				if(!$this -> $func(& $data))
				{
					$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $func);
					unset($checker);  
					unset($lang);  
					return false;
				}
			}
			else
			{
				$this -> info = $lang -> checker -> fatal_error2;
				unset($checker);  
				unset($lang);  
				return false;
			}
			echo  '<br/>';
		}
		unset($checker);  // good habit! 
		unset($lang);  // good habit! 
		return true;
	}


	public function check_array(& $data, $pattern_array,  $len_array = false) //
	{
		global $checker;
		global $lang;

		if(is_array($data) && is_array($pattern_array))
		{
			if(count($data) != count($pattern_array)) echo 'no';
			if($len_array && count($len_array) != count($pattern_array)) echo 'no';
			$i = 0;
			foreach($data as & $value)
			{
				echo $i , ' data: ', $value , ' ';
				
				// if(get_magic_quotes_gpc()) $value = stripslashes($value);
				// $value = mysql_real_escape_string($value, write_db(false));
				$this -> anti_sql_inject($value);
				
				if(is_array($pattern_array[$i]))
				{
					echo 'func array: ';
					foreach($pattern_array[$i] as $pattern)
					{
						echo $pattern , ' ';
						if(method_exists($this, $pattern))
						{
							if($len_array) // check length
							{
								if(!is_array($len_array[$i]))
								{
									$this -> info = $lang -> checker -> fatal_error3;
									unset($pattern); 
									unset($value); 
									unset($checker);  
									unset($lang);  
									return false;
								}
								$len_low = $len_array[$i][0];
								$len_high = $len_array[$i][1];
								echo ' ' , $len_low,  '-', $len_high , ' ';
								if(!$this -> check_len(& $value, $len_low, $len_high))
								{
									$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $pattern, $len_low, $len_high);
									unset($pattern); 
									unset($value); 
									unset($checker); 
									unset($lang);   
									return false;
								}
							}

							if(!$this -> $pattern(& $value)) // check pattern
							{
								$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $pattern);
								unset($value); 
								unset($pattern); 
								unset($checker); 
								unset($lang);   
								return false;
							}
						}
						else
						{
							$this -> info = $lang -> checker -> fatal_error2;
							unset($value); 
							unset($pattern); 
							unset($checker);  
							unset($lang);  
							return false;
						}
					}
					unset($pattern); 
				}
				else
				{
					$pattern = $pattern_array[$i];
					echo 'func: ' , $pattern;
					if(method_exists($this, $pattern))
					{
						if($len_array) // check length
						{
							if(!is_array($len_array[$i]))
							{
								$this -> info = $lang -> checker -> fatal_error3;
								unset($value); 
								unset($checker);  
								unset($lang);  
								return false;
							}
							$len_low = $len_array[$i][0];
							$len_high = $len_array[$i][1];
							echo ' ' , $len_low , '-', $len_high , ' ';
							if(!$this -> check_len(& $value, $len_low, $len_high))
							{
								$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> $pattern, $len_low, $len_high);
								unset($value); 
								unset($checker); 
								unset($lang);   
								return false;
							}
						}
						
						if(!$this -> $pattern(& $value)) // check pattern
						{
							$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $pattern);
							unset($value); 
							unset($checker); 
							unset($lang);   
							return false;
						}
					}
					else
					{
						$this -> info = $lang -> checker -> fatal_error2;
						unset($value); 
						unset($checker);  
						unset($lang);  
						return false;
					}
				}
				$i++;
				echo '<br/>';
			}
			unset($value); 
		} else return false;
		unset($checker);  // good habit! 
		unset($lang);  // good habit! 
		return true;
	}
	
	public function check_one(& $data)  // data must be string
	{
		global $checker;
		global $lang;
		
		if($this -> low || $this -> high)
		{
			if(!$this -> check_size($data, $this -> low, $this -> high))
			{
				$this -> info = sprintf($lang -> checker -> checker_size,$lang -> field_name -> data, $this -> low, $this -> high);
				unset($checker);
				unset($lang);
				return false;
			}
		}
		
		if($this -> len_low || $this -> len_high)
		{
			if(!$this -> check_len($data, $this -> len_low, $this -> len_high))
			{
				$this -> info = sprintf($lang -> checker -> checker_len,$lang -> field_name -> data, $this -> len_low, $this -> len_high);
				unset($checker); 
				unset($lang);  
				return false;
			}
		}
		
		$this -> anti_sql_inject($data);
		
		if($this -> preg)
		{
			if(is_array($this -> preg))
			{
				echo 'func array: ';
				foreach($this -> preg as $pattern)
				{
					echo $pattern , ' ' ;
					if(method_exists($this, $pattern))
					{
						if(!$this -> $pattern(& $data)) // check pattern
						{
							$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $pattern);
							unset($pattern); 
							unset($checker); 
							unset($lang);   
							return false;
						}
					}
					else
					{
						$this -> info = $lang -> checker -> fatal_error2;
						unset($pattern); 
						unset($checker); 
						unset($lang);
						return false;
					}
					echo '<br/>';
				}
				unset($pattern); 
			}
			else
			{
				
				$pattern = $this -> preg;
				if(method_exists($this, $pattern))
				{
					echo 'func: ' , $pattern;
					if(!$this -> $pattern(& $data)) // check pattern
					{
						$this -> info = sprintf($lang -> checker -> preg_error, $lang -> field_name -> $pattern);
						unset($checker); 
						unset($lang);   
						return false;
					}
				}
				else
				{
					$this -> info = $lang -> checker -> fatal_error2;
					unset($checker); 
					unset($lang);   
					return false;
				}
			}
		}
	}
}


	
// 对所有的数据转义单引号。
// 写另一种check方法
// 完善zh-cn

/*
function barber($type)
{
    echo "You wanted a $type haircut, no problem";
}
call_user_func('barber', "mushroom");
call_user_func('barber', "shave");

		// $this -> $type($data);
		// function_exists
		// call_user_func(array('Checker','foo'), "shave");
		
		$test[] = 1;
		if(is_array($test)) echo 'yes';
		
	if(isset($this ->data)) echo 'set!';		
*/


/*
$c = new Checker;
// $c -> add('weitao@163.comweitao@.com','foo');
$test['ID'] = '1211';
$test['user_login'] = 'ng123@2.com';
$test['ip'] = '12.45.55.50';
$test['haha'] = "Ng's iPhone";
$d = '1.1.1.51';
$c -> check($test, 'is_text',1,20);
echo $c -> info();
// echo $d;
var_dump($test);
*/


/*
$c = new Checker;
$aa = array(
	'name' => 'Jia',
	'qq' => '999888',
	'ip' => '111.111.111.11',
);

$bb = array('is_text', 'is_qq', array('is_ip','ip2int'))
;
$cc = array(
	array(1,20),
	array(1,10),
	array(1,16),
);

// echo count($aa), ' ', count($bb);
$c -> check_array($aa, $bb, $cc);
echo $c -> info();
var_dump($aa);
*/



$c = new Checker;
// $c -> set_size(0,600);
/*
$c -> set_len(1, 10);
$c -> set_pattern(array('is_ip', 'is_text'));
$data = '111.22.2.2';
$c -> check_one($data);
echo $c -> info();
*/

$login = "2011301500236' OR '1=1";
$pass = '123456';
$c -> anti_sql_inject($login);
echo $login;
$sql = "SELECT * FROM ng_user WHERE user_login='$login' AND user_pass='$pass'";
echo '<br/>' , $sql;


array(
	'user_login' => 'weitao201@163.com',
	'user_pass' => '123456',
	'user_id' => '1091',
	'hahaha' => '这个家伙很懒...',
)


?>