<?php
namespace App\Classes;


/**
 * Class Brand
 * @package App\Classes
 */
class Brand
{
    protected $id;
    protected $name;
    protected $quality;

    /**
     * Brand constructor.
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
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param mixed $quality
     */
    public function setQuality($quality): void
    {
        $this->quality = $quality;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'quality' => $this->getQuality()
        ];
    }

    public static function create(array $data): Brand
    {
        $brand = new self();

        $brand->setId($data['id']);
        $brand->setName($data['name']);
        $brand->setQuality($data['quality']);

        return $brand;
    }

    public static function createDefaultBrand(): Brand
    {
        $brand = new self();

        $brand->setId(0);
        $brand->setName('Teszt márka');
        $brand->setQuality(5);

        return $brand;
    }
}