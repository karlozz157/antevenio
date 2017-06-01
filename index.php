<?php

require 'vendor/autoload.php';

if(!session_id()) {
    session_start();
}

date_default_timezone_set('America/Mexico_City');

$medoo = new medoo([
    'database_type' => 'mysql',
    'database_name' => 'antevenio',
    'server'   => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset'  => 'utf8'
]);

if ('cli' !== php_sapi_name()) {
    require_once('app.php');
} else {
    $command = new Antevenio\Command\AntevenioCommand();
    $command->setMedoo($medoo);
    $command->execute();
}
