<?php

namespace AddressApi\Model;

use AddressApi\DBConnection;

class Address implements \JsonSerializable
{
    private $id;

    private $label;

    private $street;

    private $houseNumber;

    private $postalCode;

    private $city;

    private $country;

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     *
     * @return $this
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this;
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @param int $id
     *
     * @return Address|null
     */
    public static function find($id)
    {
        if ($result = DBConnection::getInstance()->query("SELECT * FROM ADDRESS WHERE ADDRESSID=$id")) {
            return self::fromArray($result->fetch_assoc());
        }

        return null;
    }

    /**
     * @return array|Address[]
     */
    public static function findAll()
    {
        $models = [];

        if ($result = DBConnection::getInstance()->query("SELECT * FROM ADDRESS")) {
            while ($row = $result->fetch_assoc()) {
                $models[] = self::fromArray($row);
            }
        }

        return $models;
    }

    /**
     * @param array $data
     *
     * @return Address
     */
    private static function fromArray(array $data)
    {
        $neededValues = ['ADDRESSID', 'LABEL', 'CITY', 'COUNTRY', 'HOUSENUMBER', 'POSTALCODE'];

//        if (array_keys($data) != $neededValues) { todo find out nice checking
//            throw new \InvalidArgumentException();
//        }

        return (new Address())
            ->setId(isset($data['ADDRESSID']) ? $data['ADDRESSID'] : null)
            ->setLabel($data['LABEL'])
            ->setCity($data['CITY'])
            ->setCountry($data['COUNTRY'])
            ->setHouseNumber($data['HOUSENUMBER'])
            ->setPostalCode($data['POSTALCODE'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return [
            'ADDRESSID'   => $this->getId(),
            'LABEL'       => $this->getLabel(),
            'CITY'        => $this->getCity(),
            'COUNTRY'     => $this->getCountry(),
            'HOUSENUMBER' => $this->getHouseNumber(),
            'POSTALCODE'  => $this->getPostalCode(),
        ];
    }
}
