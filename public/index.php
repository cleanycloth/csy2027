<?php
require '../autoload.php';

$routes = new \NNGames\Routes();

$entryPoint = new \CSY2028\EntryPoint($routes);

$entryPoint->run();
?>