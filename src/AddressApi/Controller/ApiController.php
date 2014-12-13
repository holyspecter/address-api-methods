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

    public function createAction()
    {
        $address = Address::fromArray($_POST);

        $address->save();
    }

    public function showAction()
    {
        echo json_encode(Address::find($this->getIdFromUrl()));
        die;
    }

    public function updateAction()
    {
        parse_str(file_get_contents("php://input"), $data);

        $address = Address::fromArray(array_merge($data, ['ADDRESSID' => $this->getIdFromUrl()]));

        $address->save();
    }

    /**
     * @return int
     */
    private function getIdFromUrl()
    {
        return (int) end(explode('/', $_GET['url']));
    }
} 
