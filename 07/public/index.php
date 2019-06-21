<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/../vendor/Autoload.php');
$config = include($_SERVER['DOCUMENT_ROOT'] . '/../main/config.php');
\App\main\App::call()->run($config);