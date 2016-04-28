## TitanDB
Simple query builder and PDO Class for PHP

[![Total Downloads](https://poser.pugx.org/tkaratug/titan-db/d/total.svg)](https://packagist.org/packages/tkaratug/titan-db)
[![License](https://poser.pugx.org/tkaratug/titan-db/license.svg)](https://packagist.org/packages/tkaratug/titan-db)

## Install
Run the following command directly.

```
$ composer require tkaratug/titan-db:dev-master
```

## Example
```php
require 'vendor/autoload.php';

$config = [
	'db_driver'		=> 'mysql',
	'db_host'		=> 'localhost',
	'db_user'		=> 'root',
	'db_pass'		=> '',
	'db_name'		=> 'test',
	'db_charset'	=> 'utf8',
	'db_collation'	=> 'utf8_general_ci',
	'db_prefix'	 	=> ''
];

$db = new TitanDB($config);

$records 	= $db->select('user_id, first_name, last_name, email')
				 ->from('users')
				 ->where('active', 1)
				 ->order_by('user_id', 'asc')
				 ->get()
				 ->results();			 
var_dump($records);

// Get all columns
$records	= $db->get('users')->results();
var_dump($records);

// Get all columns in a row
$db->where('user_id', 5);
$records	= $db->get('users')->row();
var_dump($records);

// JOIN Usage
$record 	= $db->select('t1.user_id, t1.first_name, t1.last_name, t2.group_name')
				 ->from('users as t1')
				 ->join('groups as t2', 't1.user_id=t2.user_id', 'left')
				 ->where('t1.active', 1)
				 ->get()
				 ->results();
var_dump($record);

// INSERT Usage
$data = [
	'first_name' 	=> 'John',
	'last_name'		=> 'Doe',
	'email'			=> 'john@doe.com'
];

$db->insert('users', $data);

// UPDATE Usage
$data = [
	'first_name' 	=> 'John',
	'last_name'		=> 'Doe',
	'email'			=> 'john@doe.com'
];

$db->where('user_id', 5);
$db->update('users', $data);

// DELETE Usage
$db->where('user_id', 5);
$db->delete('users');
```

## Licence
[MIT Licence][df1]

[df1]: <http://opensource.org/licenses/MIT>