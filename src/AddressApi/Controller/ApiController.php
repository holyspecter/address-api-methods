<?php

namespace AddressApi\Controller;

use AddressApi\Model\Address;

class ApiController
{
    public function listAction()
    {
        echo json_encode(Address::findAll());
        die;
    }

    public function showAction()
    {
        echo json_encode(Address::find($this->getIdFromUrl()));
        die;
    }

    /**
     * @return int
     */
    private function getIdFromUrl()
    {
        return (int) end(explode('/', $_GET['url']));
    }
} 
