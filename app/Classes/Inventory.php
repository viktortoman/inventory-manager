<?php
namespace App\Classes;


/**
 * Class Inventory
 * @package App\Classes
 */
class Inventory
{
    protected $id;
    protected $name;
    protected $address;
    protected $capacity;
    protected $stock;

    /**
     * Inventory constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'address' => $this->getAddress(),
            'capacity' => $this->getCapacity(),
            'stock' => $this->getStock()
        ];
    }

    public static function create(array $data): Inventory
    {
        $inventory = new self();

        $inventory->setId($data['id']);
        $inventory->setName($data['name']);
        $inventory->setAddress($data['address']);
        $inventory->setCapacity($data['capacity']);
        $inventory->setStock($data['stock']);

        return $inventory;
    }
}