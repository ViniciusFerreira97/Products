<?php

namespace App\Http\Controllers;

use App\Repository\ReserveRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReserveController extends Controller
{
    protected ReserveRepository $reserve;

    public function __construct(ReserveRepository $reserve)
    {
        $this->reserve = $reserve;
    }

    public function getAll() 
    {
        return $this->reserve->all();
    }

    public function create(Request $request)
    {
        $request->validate([
            'id_product' => 'required|exists:tb_product,id_product',
            'quantity_reserve' => 'required|int'
        ]);

        $newReserve = $this->reserve->create($request->all());
        
        if (!$newReserve) {
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }

        return $newReserve;
    }

    public function delete($id_reserve)
    {
        $reserveDelete = $this->reserve->byId($id_reserve);
        $this->reserve->delete($reserveDelete);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
