<?php

namespace App\Http\Controllers;

use App\Jobs\ImportExcelJob;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    protected ProductRepository $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function getAll() 
    {
        return $this->product->all();
    }

    public function getById($id_product)
    {
        return $this->product->byId($id_product);
    }

    public function create(Request $request)
    {
        $request->validate([
            'id_client' => 'required|exists:tb_client,id_client',
            'sku_product' => 'required',
            'quantity_product' => 'required|int'
        ]);

        $newProduct = $this->product->create($request->all());

        return $newProduct;
    }

    public function delete($id_product)
    {
        $productDelete = $this->product->byId($id_product);
        $this->product->delete($productDelete);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:tb_product,id_product',
            'quantity_product' => 'required|int'
        ]);
        
        $productUpdate = $this->product->byId($request->id_product);
        $productEdited = $this->product->update($productUpdate, $request->all());

        return $productEdited;
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $tempPath = $request->file('file')->store('temp');
        $definitivePath = storage_path('app').'/'.$tempPath;
        $this->dispatch(new ImportExcelJob($definitivePath));

        return response()->json(null, Response::HTTP_OK);
    }

}
