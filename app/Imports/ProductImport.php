<?php

namespace App\Imports;

use App\Repository\ProductRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    protected ProductRepository $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function model(array $row)
    {
        $importProduct = [
            'id_client' => $row['client'],
            'sku_product' => $row['sku'],
            'quantity_product' => $row['quantity']
        ];

        $this->product->import($importProduct);
    }
}
