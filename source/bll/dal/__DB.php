<?php
/*
Author: Ng1091
Date: 2013-11-17 2014-02-03
Description: 
*/

require_once('__select.php');
require_once('__update.php');
require_once('__insert.php');
require_once('__delete.php');

/*
Author: ng1091
Date: 2013-11-09 
Description: 抽象类
*/

abstract class Base_Class 
{
	protected $table_name;
	protected $id_name;
	protected $order;

	// 以下是对提供给子类的protected方法
	protected function get_by($what)
	{
		if($this -> mode) $res = select('*', $this->table_name, $what);
		else $res = select($this -> what, $this->table_name, $what);
		return mysql_fetch_array($res);
	}

	protected function getm_by($what) // Multi
	{
		if($this -> order) $what .= 'ORDER BY ' . $this -> order;
		if($this -> mode) $res = select('*', $this->table_name, $what);
		else $res = select($this -> what, $this->table_name, $what);
		return $res;
	}
	
	protected function update_by($what, $key)
	{
		return update($this->table_name, $what, $key);
	}
	
	protected function insert_by($what)
	{
		return insert($what, $this->table_name);
	}
	
	protected function delete_by($what)
	{
		return delete($this->table_name, $what);
	}
	
	// 以下2个方法用于meta表
	protected function insert_meta_by_id($id, $meta_key, $meta_value)
	{
		$para = array(
			"$this->meta_name" => $id,
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
		);
		return insert_by($para);
	}
	
	protected function insert_meta($meta_key, $meta_value)
	{
		$para = array(
			'meta_key' => $meta_key,
			'meta_value' => $meta_value,
		);
		return insert_by($para);
	}
	
	
	// 以下为提供给子类的公共方法
	
	function get_by_id($id)
	{
		return $this -> get_by("$this->id_name='$id' limit 1");
	}
	
	function update_by_id($para, $id)
	{
		return $this -> update_by($para, "$this->id_name='$id' limit 1");
	}

	function delete_by_id($id)
	{
		return $this -> delete_by("$this->id_name='$id' limit 1");
	}
	
	function insert($para)
	{
		return $this -> insert_by($para);
	}

	// 以下是对属性操作的公共方法
	function set_select($what)
	{
		$this -> what = $what;
	}
	
	function set_default()
	{
		$this -> what = $this -> default_what;
	}
	
	function simple_mode()
	{
		$this -> mode = 0;
	}
	
	function complex_mode()
	{
		$this -> mode = 1;
	}
	
	function set_order($order)
	{
		$this -> order = $order;
	}
	
	function clear_order()
	{
		$this -> order = false;
	}
	
	function show_select() // 用于调试，日后要删
	{
		echo $this -> what;
	}
	
	function show_order() // 同上
	{
		echo $this -> order;
	}
	
}


/*
Author: ng1091
Date: 2013-11-09 2014-01-28
Description: user表操作
*/


class User extends Base_Class 
{
	protected $table_name = 'ng_user';
	protected $id_name = 'ID';
	protected $mode = 0;
	protected $default_what = 'ID, user_nickname';
	protected $what = 'ID, user_nickname';
	
	function get_by_login($login)
	{
		return $this -> get_by("user_login='$login' limit 1");
	}
	
	function get_by_stuid($stuid)
	{
		return $this -> get_by("user_stuid='$stuid' limit 1");
	}
	
	function login_by_email($login, $pass)
	{
		$res = self::get_by_login($login);
		if($res && $res["user_pass"] == $pass) return $res;
		else return false;
	}
	
	function login_by_stuid($stuid, $pass)
	{
		$res = self::get_by_stuid($stuid);
		if($res && $res["user_pass"] == $pass) return $res;
		else return false;
	}
}


/*
Author: ng1091
Date: 2014-01-29
Description: class表操作 （以下省略开发者信息，写多了没意思）
*/

class iClass extends Base_Class
{
	protected $table_name = 'ng_class';
	protected $id_name = 'ID';
	protected $mode = 0;
	protected $default_what = 'ID, class_name, class_subhead, class_parent, class_level, class_status';
	protected $what = 'ID, class_name, class_subhead, class_parent, class_level, class_status';
	
	function get_by_name($name) //Multi
	{
		return $this -> getm_by("class_name like '%$name%'");
	}
	
	function get_by_subhead($name) //Multi
	{
		return $this -> getm_by("class_subhead like '%$name%'");
	}
	
	function get_by_parent($id) //Multi
	{
		return $this -> getm_by("class_parent='$id'");
	}
	
	function get_by_status($id) //Multi
	{
		return $this -> getm_by("class_status='$id'");
	}
	
	function get_by_level($level) //Multi
	{
		return $this -> getm_by("class_level='$level'");
	}
}



class User_Class extends Base_Class
{
	protected $table_name = 'ng_user_class';
	protected $id_name = 'user_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode()
	{
		$this -> mode = 1;
	}
	
	function get_by_user_id($id) //Multi
	{
		return $this -> getm_by("user_id='$id'");
	}
	
	function get_by_class_id($id) //Multi
	{
		return $this -> getm_by("class_id='$id'");
	}
	
	// 此表主键有2个属性，因此重写以下公共方法
	function get_by_id($user, $class)  // 此id代表主键key的意思
	{
		return $this -> get_by("user_id='$user' AND class_id='$class' limit 1");
	}
	
	function update_by_id($para, $user, $class)
	{
		return $this -> update_by($para, "user_id='$user' AND class_id='$class' limit 1");
	}
	
	function delete_by_id($user, $class)
	{
		return $this -> delete_by("user_id='$user' AND class_id='$class' limit 1");
	}
}
	


class Submit extends Base_Class
{
	protected $table_name = 'ng_submit';
	protected $id_name = 'user_id';
	protected $mode = 0;
	protected $default_what = 'post_id, user_id, submit_date';
	protected $what = 'post_id, user_id, submit_date';
	
	
	function get_by_user_id($id) //Multi
	{
		return $this -> getm_by("user_id='$id'");
	}
	
	function get_by_post_id($id) //Multi
	{
		return $this -> getm_by("post_id='$id'");
	}
	
	function count_inc($user, $post)
	{
		$k = $this -> mode;
		$this -> complex_mode();
		$res = $this -> get_by_id($user, $post);
		$new["submit_count"] = $res["submit_count"] + 1;
		$this -> mode = $k;
		return $this -> update_by_id($new, $user, $post);
	}
	
// SELECT DATE_FORMAT( submit_date,  '%Y-%m' ) AS month , COUNT(*) AS num FROM  `whusub` GROUP BY MONTH"

	// 此表主键有2个属性，因此重写以下公共方法
	function get_by_id($user, $post)  // 此id代表主键key的意思
	{
		return $this -> get_by("user_id='$user' AND post_id='$post' limit 1");
	}
	
	function update_by_id($para, $user, $post)
	{
		return $this -> update_by($para, "user_id='$user' AND post_id='$post' limit 1");
	}
	
	function delete_by_id($user, $post)
	{
		return $this -> delete_by("user_id='$user' AND post_id='$post' limit 1");
	}
	
}


class Log extends Base_Class
{
	protected $table_name = 'ng_log';
	protected $id_name = 'log_id';
	protected $mode = 0;
	protected $default_what = 'log_id, login_user, login_date, login_IP';
	protected $what = 'log_id, login_user, login_date, login_IP';
	
	function get_last_by_user($user) 
	{
		return $this -> get_by("login_user='$user' order by $this->id_name desc limit 1");
	}
	
	function get_by_user($user)  // Multi
	{
		return $this -> getm_by("login_user='$user' order by $this->id_name desc");
	}
	
	function login($user, $ip, $agent)
	{
		$rec = array (
			'login_user' => "$user",
			'login_date' => time(),
			'login_ip' => $ip,
			'login_agent' => $agent,
		);
		return $this -> insert($rec);
	}
}

class Post extends Base_Class
{
	protected $table_name = 'ng_post';
	protected $id_name = 'ID';
	protected $mode = 0;
	protected $default_what = 'ID, post_class, post_deadline, comment_count, read_count, hand_count, post_title, post_subhead';
	protected $what = 'ID, post_class, post_deadline, comment_count, read_count, hand_count, post_title, post_subhead';

	
	function get_user_by_id($id)  // 实际上private方法，仅用于 Comment::new_comment()
	{
		$res = select('post_user', $this->table_name, "$this->id_name='$id' limit 1");
		return mysql_fetch_array($res);
	}
	
	function get_by_user($user)  // Multi
	{
		return $this -> getm_by("post_user='$user' AND post_parent='0'");
	}

	function get_by_class($class)  // Multi
	{
		return $this -> getm_by("post_class='$class' AND post_parent='0'");
	}

	function get_by_parent($id)  // Multi
	{
		return $this -> getm_by("post_parent='$id'");
	}
	
	private function get_by_multi_class($class)  // Multi
	{
		$first = 1;
		foreach($class as $num)
		{
			if($first) $first = 0;
			else $str .= 'OR ';
			$str .= "post_class='$num' ";
		}
		return $this -> getm_by("($str) AND post_parent='0'");
	}
	
	function get_list($user)  // for_each, false means not found
	{
		$uc = new User_Class;
		$res = $uc -> get_by_user_id($user);
		while($row = mysql_fetch_array($res))
		{
			$class[] = $row['class_id'];
		}
		if($class == false) return false;
		$p = $this -> get_by_multi_class($class);
		while($r = mysql_fetch_array($p))
		{
			$result[] = $r;
		}
		return $result;
	}
	
	function new_post($post_user, $post_class, $post_deadline, $post_type, $post_title, $post_subhead, $post_content)
	{
		$para = array (
			'post_user' => $post_user,
			'post_class' => $post_class,
			'post_date' => time(),
			'post_deadline' => $post_deadline,
			'post_type' => $post_type,
			'post_title' => $post_title,
			'post_subhead' => $post_subhead,
			'post_content' => $post_content,
		);
		return $this -> insert($para);
	}


}


class Comment extends Base_Class
{
	protected $table_name = 'ng_comment';
	protected $id_name = 'comment_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	private function get_comment_user_by_id($id)
	{
		$res = select('comment_user_id', $this->table_name, "comment_id='$id' limit 1");
		return mysql_fetch_array($res);
	}
	
	private function get_post_user_by_id($id)
	{
		$res = select('comment_post_id', $this->table_name, "comment_id='$id' limit 1");
		return mysql_fetch_array($res);
	}
	
	function get_by_user($user)  // Multi
	{
		return $this -> getm_by("comment_user_id='$user'");
	}

	function get_by_post($post)  // Multi
	{
		return $this -> getm_by("comment_post_id='$post'");
	}

	function get_by_parent($id)  // Multi
	{
		return $this -> getm_by("comment_parent='$id'");
	}
	
	function good($comment_id, $user_id)
	{
		$type = 1;
		$r = new Rec;
		$rec = $r -> get_by_id($user_id, $comment_id, $type);
		if($rec) return false;
		$res = $this -> get_by_id($comment_id);
		$new["comment_good"] = $res["comment_good"] + 1;
		$r -> new_rec($user_id, $comment_id, $type);
		return $this -> update_by_id($new, $comment_id);
	}
	
	function good_cancel($comment_id, $user_id)
	{
		$type = 1;
		$r = new Rec;
		$rec = $r -> get_by_id($user_id, $comment_id, $type);
		if($rec == false) return false;
		$res = $this -> get_by_id($comment_id);
		$new["comment_good"] = $res["comment_good"] - 1;
		$para = array('type' => 0);
		$r -> update_by_id($para, $user_id, $comment_id, $type);
		return $this -> update_by_id($new, $comment_id);
	}
	
	function bad($comment_id, $user_id)
	{
		$type = 2;
		$r = new Rec;
		$rec = $r -> get_by_id($user_id, $comment_id, $type);
		if($rec) return false;
		$res = $this -> get_by_id($comment_id);
		$new["comment_bad"] = $res["comment_bad"] + 1;
		$r -> new_rec($user_id, $comment_id, 2);
		return $this -> update_by_id($new, $comment_id);
	}
	
	function bad_cancel($comment_id, $user_id)
	{
		$type = 2;
		$r = new Rec;
		$rec = $r -> get_by_id($user_id, $comment_id, $type);
		if($rec == false) return false;
		$res = $this -> get_by_id($comment_id);
		$new["comment_bad"] = $res["comment_bad"] - 1;
		$para = array('type' => 0);
		$r -> update_by_id($para, $user_id, $comment_id, $type);
		return $this -> update_by_id($new, $comment_id);
	}
	
	function new_comment($post, $user, $content)
	{
		$rec = array (
			'comment_post_id' => $post,
			'comment_user_id' => $user,
			'comment_content' => $content,
			'comment_date' => time(),
		);
		$result = $this -> insert($rec);
		$id = mysql_insert_id();
		if($id) {
			// 查找post的作者,给其发送通知。（如果是自己，则不发送）
			$p = new Post;
			$pr = $p -> get_comment_user_by_id($post);
			$post_user = $pr['post_user'];
			if($post_user && $post_user != $user)
			{
				$noti = new Noti;
				$noti -> new_noti($id, $post_user, 0);
			}
		}
		return $result;
	}
	
	function reply($comment_id, $user, $content)
	{
		$res = select('comment_user_id,comment_post_id', $this->table_name, "comment_id='$comment_id' limit 1");
		$pr = mysql_fetch_array($res);
		$post = $pr['comment_post_id'];
		$comment_user = $pr['comment_user_id'];
		$rec = array (
			'comment_post_id' => $post,
			'comment_user_id' => $user,
			'comment_content' => $content,
			'comment_date' => time(),
			'comment_parent' => $comment_id,
		);
		$result = $this -> insert($rec);
		$id = mysql_insert_id();
		if($id) 
		{
			$noti = new Noti;
			//查找post的作者,给其发送通知。（如果是自己，则不发送）
			$p = new Post;
			$pr = $p -> get_user_by_id($post);
			$post_user = $pr['post_user'];
			if($post_user && $post_user != $user) 
			{
				$noti -> new_noti($id, $post_user, 0);
			}
			// 给被回复的用户发送通知，（如果是自己，不发送）
			if($comment_user && $comment_user != $user) 
			{
				$noti -> new_noti($id, $comment_user, 0);
			}
		}
		return $result;
	}
}


class Rec extends Base_Class
{
	protected $table_name = 'ng_rec';
	protected $id_name = 'rec_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	function new_rec($user, $comment, $type)
	{
		$rec = array (
			'user_id' => $user,
			'comment_id' => $comment,
			'type' => $type,
			'date' => time(),
		);
		return $this -> insert($rec);
	}
	
	// 重写以下公共方法
	function get_by_id($user, $comment, $type)  // 此id代表主键key的意思
	{
		return $this -> get_by("user_id='$user' AND comment_id='$comment' AND type='$type' limit 1");
	}
	
	function update_by_id($para, $user, $comment, $type)
	{
		return $this -> update_by($para, "user_id='$user' AND comment_id='$comment' AND type='$type' limit 1");
	}
	
	function delete_by_id($user, $comment, $type)
	{
		return $this -> delete_by("user_id='$user' AND comment_id='$comment' AND type='$type' limit 1");
	}
}

class Noti extends Base_Class
{
	protected $table_name = 'ng_noti';
	protected $id_name = 'noti_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	function get_by_user($user)  // Multi
	{
		return $this -> getm_by("user_id='$user'");
	}
	
	function new_noti($comment, $user, $type)
	{
		$rec = array (
			'comment_id' => $comment,
			'user_id' => $user,
			'noti_type' => $type,
		);
		return $this -> insert($rec);
	}
	
	function read_noti($noti_id)
	{
		$para = array('noti_read' => true);
		return $this -> update_by_id($para, $noti_id);
	}
}



class User_Meta extends Base_Class
{
	protected $table_name = 'ng_usermeta';
	protected $id_name = 'meta_id';
	protected $meta_name = 'user_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	function get_by_meta_id($id)
	{
		return $this -> get_by_id($id);
	}
	
	function get_by_user_id($id) //Multi
	{
		return $this -> getm_by("user_id='$id'");
	}
	
	function get_by_meta_key($user_id, $meta_key)
	{
		return $this -> get_by("user_id='$user_id' AND meta_key='$meta_key' limit 1");
	}
	
	function update_by_meta_key($para, $user_id, $meta_key)
	{
		return $this -> update_by($para, "user_id='$user_id' AND meta_key='$meta_key' limit 1");
	}
	
	function delete_by_meta_key($user_id, $meta_key)
	{
		return $this -> delete_by("user_id='$user_id' AND meta_key='$meta_key' limit 1");
	}
	
	function new_meta($user_id, $meta_key, $meta_value)
	{
		return $this -> insert_meta_by_id($user_id, $meta_key, $meta_value);
	}
}


class Comment_Meta extends Base_Class
{
	protected $table_name = 'ng_commentmeta';
	protected $id_name = 'meta_id';
	protected $meta_name = 'comment_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	function get_by_meta_id($id)
	{
		return $this -> get_by_id($id);
	}
	
	function get_by_comment_id($id) //Multi
	{
		return $this -> getm_by("comment_id='$id'");
	}
	
	function get_by_meta_key($comment_id, $meta_key)
	{
		return $this -> get_by("comment_id='$comment_id' AND meta_key='$meta_key' limit 1");
	}
	
	function update_by_meta_key($para, $comment_id, $meta_key)
	{
		return $this -> update_by($para, "comment_id='$comment_id' AND meta_key='$meta_key' limit 1");
	}
	
	function delete_by_meta_key($comment_id, $meta_key)
	{
		return $this -> delete_by("comment_id='$comment_id' AND meta_key='$meta_key' limit 1");
	}
	
	function new_meta($comment_id, $meta_key, $meta_value)
	{
		return $this -> insert_meta_by_id($comment_id, $meta_key, $meta_value);
	}
}


class Post_Meta extends Base_Class
{
	protected $table_name = 'ng_postmeta';
	protected $id_name = 'meta_id';
	protected $meta_name = 'post_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}
	
	function get_by_meta_id($id)
	{
		return $this -> get_by_id($id);
	}
	
	function get_by_post_id($id) //Multi
	{
		return $this -> getm_by("post_id='$id'");
	}
	
	function get_by_meta_key($post_id, $meta_key)
	{
		return $this -> get_by("post_id='$post_id' AND meta_key='$meta_key' limit 1");
	}
	
	function update_by_meta_key($para, $post_id, $meta_key)
	{
		return $this -> update_by($para, "post_id='$post_id' AND meta_key='$meta_key' limit 1");
	}
	
	function delete_by_meta_key($post_id, $meta_key)
	{
		return $this -> delete_by("post_id='$post_id' AND meta_key='$meta_key' limit 1");
	}
	
	function new_meta($post_id, $meta_key, $meta_value)
	{
		return $this -> insert_meta_by_id($post_id, $meta_key, $meta_value);
	}
}


class Meta extends Base_Class
{
	protected $table_name = 'ng_meta';
	protected $id_name = 'meta_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}

	
	function get_by_meta_key($meta_key)
	{
		return $this -> get_by("meta_key='$meta_key' limit 1");
	}
	
	function update_by_meta_key($para, $meta_key)
	{
		return $this -> update_by($para, "meta_key='$meta_key' limit 1");
	}
	
	function delete_by_meta_key($meta_key)
	{
		return $this -> delete_by("meta_key='$meta_key' limit 1");
	}
	
	function new_meta($meta_key, $meta_value)
	{
		return $this -> insert_meta($meta_key, $meta_value);
	}
}

class Option extends Base_Class
{
	protected $table_name = 'ng_option';
	protected $id_name = 'option_id';
	protected $mode = 1;
	
	// 本类无simple mode， 重写此方法
	function simple_mode(){$this -> mode = 1;}

	
	function get_by_name($name)
	{
		return $this -> get_by("option_name='$name' limit 1");
	}
	
	function update_by_name($para, $meta_key)
	{
		return $this -> update_by($para, "meta_key='$meta_key' limit 1");
	}
	
	function delete_by_meta_key($meta_key)
	{
		return $this -> delete_by("meta_key='$meta_key' limit 1");
	}
	
	function new_meta($meta_key, $meta_value)
	{
		return $this -> insert_meta($meta_key, $meta_value);
	}
}




/*
$c = new Comment;
$d = $c -> bad(5,2);
var_dump($d);
*/



// while($row = mysql_fetch_array($d))
// {
	// var_dump($row);
	// echo '<br/>';

// }


// $d = $l -> get_by_user(1);


// while($row = mysql_fetch_array($d))
// {
	// var_dump($row);
	// echo '<br/>';

// }

/*
$d = $class->get_by_level(3);
$d = mysql_fetch_array($d);
var_dump($d);
*/



/*
改成静态成员private
改成静态方法static
this换成self
*/



/*
$user_meta = new User_Meta;
$para = array(
	"meta_key" => "sign",
	"meta_value" => "1222",
	"user_id" => '4',
);
*/

// echo $user_meta -> insert($para);


// $d = $user_meta -> update_by_id($para,4);
// echo $d;




// $a = new User;

/*
$d = $a -> delete_by_id(10);
var_dump($d);
echo '<br/>' . $d;
*/


// $d = $a -> get_by_id(1);
// var_dump($d);

/*
$d = $a -> login_by_stuid("hanmm@163.com", "123123");
if($d) {
	echo 'success<br/>';
	var_dump($d);
}
else echo 'failed';
*/

//echo '<br/>' . $d["user_nickname"];
//echo $a -> table_name;

/*
$temp["user_nickname"] = "HMM";
$d = $a -> update_by_id($temp, 3);
var_dump($d);
echo "<br/> $d";
*/

/*
$user = array(
	"user_login" => "584885438.com",
	"user_pass" => "666666",
	"user_passkey" => "584passkey",
	"user_registered" => time(),
	"user_stuid" => "2011301500584",
	"user_nickname" => "geng",
	"user_name" => "小号",
);

$d = $a -> insert($user);
*/



?>