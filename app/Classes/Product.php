<?php
namespace App\Classes;


/**
 * Class Product
 * @package App\Classes
 */
class Product
{
    protected $id;
    protected $itemNumber;
    protected $name;
    protected $price;
    protected $brand;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->setBrand(Brand::createDefaultBrand());
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
    public function getItemNumber()
    {
        return $this->itemNumber;
    }

    /**
     * @param mixed $itemNumber
     */
    public function setItemNumber($itemNumber): void
    {
        $this->itemNumber = $itemNumber;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'brand' => $this->getBrand()->toArray(),
            'itemNumber' => $this->getItemNumber(),
            'price' => $this->getPrice()
        ];
    }

    public static function create(array $data): Product
    {
        $product = new self();

        $product->setId($data['id']);
        $product->setItemNumber($data['itemNumber']);
        $product->setName($data['name']);
        $product->setPrice($data['price']);

        if (isset($data['brand'])) {
            $product->setBrand($data['brand']);
        }

        return $product;
    }
}