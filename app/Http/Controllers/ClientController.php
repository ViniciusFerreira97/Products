<?php

namespace App\Http\Controllers;

use App\Repository\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    protected ClientRepository $client;

    public function __construct(ClientRepository $client)
    {
        $this->client = $client;
    }

    public function getAll() 
    {
        return $this->client->all();
    }

    public function create(Request $request)
    {
        $request->validate([
            'nm_client' => 'required'
        ]);

        $newClient = $this->client->create($request->all());

        return $newClient;
    }

    public function delete($id_client)
    {
        $clientDelete = $this->client->byId($id_client);
        $this->client->delete($clientDelete);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
