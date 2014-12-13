<?php

require_once '../bootstrap.php';

$controller = new \AddressApi\Controller\ApiController();

//var_dump($_GET);

\AddressApi\Router::handleRoute();
