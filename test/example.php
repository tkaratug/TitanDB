<?php

require '../src/titandb.php';

$config = [
	'db_driver'		=> 'mysql',
	'db_host'		=> 'localhost',
	'db_user'		=> 'root',
	'db_pass'		=> '',
	'db_name'		=> 'test',
	'db_charset'	=> 'utf8',
	'db_collation'	=> 'utf8_general_ci',
	'db_prefix'		=> ''
];

$db = TitanDB::init($config);

$db->where('active', 1);
$records = $db->get('users')->results();
var_dump($records);

$db->select('user_id, username, usermail')
	->from('users')
	->where('active', 1)
	->where('banned', 0)
	->order_by('user_id', 'asc');
$records = $db->get()->results();
var_dump($records);

$record = $db->select('*')->from('users')->where('id', 1)->get()->row();
var_dump($record);

$record = $db->select('t1.user_id, t1.first_name, t1.last_name, t2.group_name')
			 ->from('users as t1')
			 ->join('groups as t2', 't1.user_id=t2.user_id', 'left')
			 ->where('t1.active', 1)
			 ->get()
			 ->results();
var_dump($record);

?>
