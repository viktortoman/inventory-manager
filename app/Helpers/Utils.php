<?php

namespace App\Helpers;

use App\Classes\Brand;
use App\Classes\Inventory;
use App\Classes\Product;

class Utils
{
    const TYPE_ADD = 1;
    const TYPE_REMOVE = 2;

    public function start(): array
    {
        try {
            $brands = $this->createBrands();
            $products = $product1 = $product2 = $product3 = $inventoryResponse = array();

            if ($brands['success']) {
                $products = $this->createProductsByBrand($brands['data']);
                $products = $products['data'];

                $product1 = $products[0];
                $product2 = $products[1];
                $product3 = $products[2];
            }

            if (!empty($products)) {
                $inventoryData = [
                    array(
                        'id' => 1,
                        'name' => '1.es raktár',
                        'address' => 'Szeged',
                        'capacity' => 10,
                        'stock' => [[
                            'quantity' => 5,
                            'product' => $product1
                        ], [
                            'quantity' => 5,
                            'product' => $product2
                        ]]
                    ),
                    array(
                        'id' => 1,
                        'name' => '2.es raktár',
                        'address' => 'Budapest',
                        'capacity' => 20,
                        'stock' => [[
                            'quantity' => 5,
                            'product' => $product2
                        ], [
                            'quantity' => 5,
                            'product' => $product3
                        ]]
                    ),
                ];

                $inventories = $this->createInventory($inventoryData);

                $testInventory = $inventories['data'][0];

                //add plus quantity to inventory product
                $inventory = $this->addOrRemoveNewProductToInventory($testInventory, $product1, 2, $this::TYPE_ADD);

                //remove quantity from inventory product
                //$inventory = $this->addOrRemoveNewProductToInventory($testInventory, $product1, 1, $this::TYPE_REMOVE);

                $inventoryResponse = $this->getAllProductsInInventory($inventory);
            }

            return [
                'success' => true,
                'data' => $inventoryResponse
            ];

        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAllProductsInInventory(array $inventory)
    {

        $this->pre($inventory);
        die;

        return [
            'inventory' => $inventory['name'],
            'products' => $inventory['stock'],
        ];
    }

    public function addOrRemoveNewProductToInventory(array $inventory, array $product, int $quantity, int $type): array
    {
        $stock = $inventory['stock'];
        $capacity = $inventory['capacity'];
        $err = '';
        $success = true;

        foreach ($stock as $key => $item) {
            if ($item['product']['id'] === $product['id']) {
                if ($type == $this::TYPE_ADD) {
                    $item['quantity'] = $item['quantity'] + $quantity;

                    if ($capacity >= $item['quantity']) {
                        $inventory['stock'][$key]['quantity'] = $item['quantity'];
                    } else {
                        $success = false;
                        $err = 'A raktár kapacítása nem haladhatja meg a: ' . $capacity . ' db terméket.';
                    }
                } else {
                    $item['quantity'] = $item['quantity'] - $quantity > 0 ? $item['quantity'] - $quantity : 0;
                    $inventory['stock'][$key]['quantity'] = $item['quantity'];
                }
            }
        }

        if ($success) {
            $response['data'] = $inventory;
        } else {
            $response['error'] = $err;
        }

        return $response;
    }

    protected function createBrands(): array
    {
        try {
            $data = array(
                'id' => 1,
                'name' => 'LG',
                'quality' => 5
            );

            $data2 = array(
                'id' => 2,
                'name' => 'Samsung',
                'quality' => 4,
            );

            $brand = Brand::create($data);
            $brand2 = Brand::create($data2);

            return [
                'success' => true,
                'data' => [
                    $brand, $brand2
                ]
            ];

        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    protected function createProductsByBrand(array $brands): array
    {
        try {
            $data = array(
                'id' => 1,
                'name' => 'Monitor',
                'itemNumber' => 'ABC12345',
                'price' => 50000,
                'brand' => $brands[0]
            );

            $data2 = array(
                'id' => 2,
                'name' => 'Hangfal',
                'itemNumber' => 'EFG12345',
                'price' => 25000,
                'brand' => $brands[1]
            );

            $data3 = array(
                'id' => 3,
                'name' => 'Billentyűzet',
                'itemNumber' => 'HJK12345',
                'price' => 15000,
            );

            $product = Product::create($data);
            $product2 = Product::create($data2);
            $product3 = Product::create($data3);

            return [
                'success' => true,
                'data' => [
                    $product->toArray(), $product2->toArray(), $product3->toArray()
                ]
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    protected function createInventory(array $inventoryData): array
    {
        try {
            $inventories = array();

            foreach ($inventoryData as $data) {
                $inventory = Inventory::create($data);
                $inventories[] = $inventory->toArray();
            }

            return [
                'success' => true,
                'data' => $inventories
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    public function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}