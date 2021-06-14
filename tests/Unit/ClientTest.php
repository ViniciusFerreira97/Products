<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class ClientTest extends TestCase
{

    use DatabaseTransactions;

    public function test_it_can_get()
    {
        $response = $this->get("/api/client/list")
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_it_can_create()
    {
        $clientFactory = Client::factory()->make();

        $response = $this->post("/api/client/create", $clientFactory->attributesToArray())
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_it_can_not_create_without_name()
    {
        $response = $this->json('post', "/api/client/create", [])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_it_can_delete()
    {
        $clientFactory = Client::factory()->create();

        $response = $this->delete("/api/client/delete/".$clientFactory->id_client)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    public function test_it_can_not_delete()
    {
        $clientFactory = Client::factory()->make();

        $response = $this->delete("/api/client/delete/".$clientFactory->id_client)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
