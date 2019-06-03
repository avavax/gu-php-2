<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/../app/services/Autoload.php');

spl_autoload_register([new App\Services\Autoload(),'loadClass']);

$good = new App\Models\Good(new App\Services\Db());

var_dump($good->getCount([1, 5, 5, 6]));
