<?php

namespace AddressApi\Controller;

use AddressApi\DBConnection;
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
        try {
            $address = Address::fromArray($this->getPreparedInput());

            echo $address->save() ? 'Success' : 'Failure';
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo "Unexpected error occurred";
        }
    }

    public function showAction()
    {
        echo json_encode(Address::find($this->getIdFromUrl()));
        die;
    }

    public function updateAction()
    {
        try {
            $address = Address::fromArray(array_merge($this->getPreparedInput(), ['ADDRESSID' => $this->getIdFromUrl()]));

            echo $address->save() ? 'Success' : 'Failure';
        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo "Unexpected error occurred";
        }

    }

    /**
     * @return int
     */
    private function getIdFromUrl()
    {
        return (int) end(explode('/', $_GET['url']));
    }

    /**
     * @return array
     */
    private function getPreparedInput()
    {
        $input = [];
        parse_str(file_get_contents("php://input"), $input);

        foreach ($input as $key => &$value) {
            $value = DBConnection::getInstance()->real_escape_string($value);
            $fieldLength = isset(Address::$fieldLengths[$key]) ? Address::$fieldLengths[$key]
                : Address::$fieldLengths['default'];
            $value = substr($value, 0, $fieldLength);
        }

        return $input;
    }
} 
