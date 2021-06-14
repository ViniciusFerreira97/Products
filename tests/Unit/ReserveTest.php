<?php

namespace Tests\Feature;

use App\Models\Reserve;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ReserveTest extends TestCase
{

    use DatabaseTransactions;

    public function test_it_can_get()
    {
        $response = $this->get("/api/reserve/list")
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_can_create()
    {
        $reserveFactory = Reserve::factory()->make();

        $response = $this->post("/api/reserve/create", $reserveFactory->attributesToArray())
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_it_can_not_create_without_quantity()
    {
        $reserveFactory = Reserve::factory()->make();
        unset($reserveFactory->quantity_reserve);

        $response = $this->json('post', "/api/reserve/create", $reserveFactory->attributesToArray())
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_can_delete()
    {
        $reserveFactory = Reserve::factory()->create();

        $response = $this->delete("/api/reserve/delete/".$reserveFactory->id_reserve)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_it_can_not_delete()
    {
        $reserveFactory = Reserve::factory()->make();

        $response = $this->delete("/api/reserve/delete/".$reserveFactory->id_reserve)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
