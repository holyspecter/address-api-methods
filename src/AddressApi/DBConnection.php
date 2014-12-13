<?php

namespace AddressApi;

class DBConnection
{
    /** @var  \mysqli */
    private static $instance;

    private function __construct() {}

    private function __clone() {}

    /**
     * @return \mysqli
     */
    public static function getInstance()
    {
        if (false == self::$instance) {
            $parameters = include PROJECT_ROOT . DIRECTORY_SEPARATOR . 'parameters.php';
            self::$instance = new \mysqli(
                $parameters['db']['host'],
                $parameters['db']['username'],
                $parameters['db']['password'],
                $parameters['db']['dbname']
            );
        }

        return self::$instance;
    }
}
