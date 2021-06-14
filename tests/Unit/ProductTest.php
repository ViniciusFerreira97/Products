<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use DatabaseTransactions;

    public function test_it_can_get()
    {
        $response = $this->get("/api/product/list")
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_can_get_id()
    {
        $productFactory = Product::factory()->create();

        $response = $this->get("/api/product/list/$productFactory->id_product")
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_can_create()
    {
        $productFactory = Product::factory()->make();

        $response = $this->post("/api/product/create", $productFactory->attributesToArray())
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_it_can_not_create_without_sku()
    {
        $productFactory = Product::factory()->make();
        unset($productFactory->sku_product);

        $response = $this->json('post', "/api/product/create", $productFactory->attributesToArray())
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_can_update()
    {
        $productFactory = Product::factory()->create();
        $productFactory->quantity_product = rand(50, 60);

        $response = $this->put("/api/product/update", $productFactory->attributesToArray())
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_can_not_update_quantity()
    {
        $productFactory = Product::factory()->create();
        unset($productFactory->quantity_product);

        $response = $this->json('put', "/api/product/update", $productFactory->attributesToArray())
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_can_delete()
    {
        $productFactory = Product::factory()->create();

        $response = $this->delete("/api/product/delete/".$productFactory->id_product)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_it_can_not_delete()
    {
        $productFactory = Product::factory()->make();

        $response = $this->delete("/api/product/delete/".$productFactory->id_product)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
