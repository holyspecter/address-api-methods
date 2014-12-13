<?php

return [
    ['method' => 'GET', 'url' => '/addresses\/[\d]+/', 'action' => 'show'],
    ['method' => 'PUT', 'url' => '/addresses\/[\d]+/', 'action' => 'update'],
    ['method' => 'GET', 'url' => '/addresses/', 'action' => 'list'],
    ['method' => 'POST', 'url' => '/addresses/', 'action' => 'create'],
];
