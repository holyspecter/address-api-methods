<?php

require_once '../bootstrap.php';

$db = \AddressApi\DBConnection::getInstance();

\AddressApi\Router::handleRoute();
