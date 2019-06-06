<?php
use App\models\User;
use App\models\Good;

include ($_SERVER['DOCUMENT_ROOT'] . '/../services/Autoload.php');

spl_autoload_register([new \App\services\Autoload(), 'loadClass']);

$user1 = new User();

$user2 = new User();

$good1 = new Good();

echo '<pre>';

// Просмотр объектов получаемых из базы
var_dump($user2->getAll());
var_dump($good1->getAll(1));

// Обновление существующего объекта
var_dump($user1->update(1, ['fio' => 'newName', 'count' => 3]));
var_dump($user1->getOne(1));

// Добавление нового объекта
$user1->insert([
		'fio' 		=> 'Putin',
		'login' 	=> 'putin',
		'password' 	=> '7bd8892e3b714543d8bb6ca71470fa9',
		'date' 		=> '2019-05-12 21:42:08',
		'count' 	=> 0,
		'is_admin' 	=> 0 
	]);
var_dump($user1->getAll());

// Удаление существующего объекта
$user1->delete(3);
var_dump($user1->getAll());

echo '</pre>';

