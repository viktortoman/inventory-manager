<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Classes\Product;
use App\Classes\Brand;
use App\Classes\Inventory;

class Test extends TestCase
{
    public function testCanBeCreatedProduct(): void
    {
        $this->assertInstanceOf(
            Product::class,
            Product::create([
                'id' => 1,
                'name' => 'Teszt Termék',
                'itemNumber' => 'ASD123456',
                'price' => 5000
            ])
        );
    }

    public function testCanBeCreatedBrand(): void
    {
        $this->assertInstanceOf(
            Brand::class,
            Brand::createDefaultBrand()
        );
    }

    public function testCanBeCreatedInventory(): void
    {
        $this->assertInstanceOf(
            Inventory::class,
            Inventory::create([
                'id' => 1,
                'name' => 'Teszt raktár',
                'address' => 'Szeged',
                'capacity' => 15,
                'stock' => []
            ])
        );
    }
}