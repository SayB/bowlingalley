<?php

use app\models\User;

$data = [
	'firstname'		=> 'Sohaib'
	, 'lastname'	=> 'Muneer'
	, 'email'		=> 'sohaib.muneer@gmail.com'
	, 'password'	=> 'sayb1234'
];

$user = User::create($data);
$result = $user->save();

var_dump($result);

$all = User::find('all');

var_dump($all);


//$dsn = 'mysql:host=127.0.0.1;dbname=trkr';
//
//$conn = new PDO($dsn, 'noroot', 'this.is.root.god');

die('done');