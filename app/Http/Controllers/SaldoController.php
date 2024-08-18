<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SaldoResource;
use App\Http\Requests\StoreSaldoRequest;
use App\Http\Requests\UpdateSaldoRequest;
use App\Classes\ApiResponseClass as ResponseClass;
use App\Interfaces\Interfaces\SaldoRepositoryInterface;
use App\Interfaces\Interfaces\TransferenciaRepositoryInterface;

class SaldoController extends Controller
{
    private SaldoRepositoryInterface $saldoRepositoryInterface;

    public function __construct(SaldoRepositoryInterface $saldoRepositoryInterface)
    {
        $this->saldoRepositoryInterface = $saldoRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->saldoRepositoryInterface->index();

        return ResponseClass::sendResponse(SaldoResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaldoRequest $request)
    {
        $details =[
            'saldo' => $request->saldo,
            'id_usuario' => $request->id_usuario
        ];

        DB::beginTransaction();

        try{
             $saldo = $this->saldoRepositoryInterface->store($details);

             DB::commit();
             return ResponseClass::sendResponse(new SaldoResource($saldo),'Saldo criado com sucesso',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->saldoRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new SaldoResource($product),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaldoRequest $request, $id)
    {
        $updateDetails =[
            'saldo' => $request->saldo,
        ];
        DB::beginTransaction();
        try{
             $saldo = $this->saldoRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ResponseClass::sendResponse('Saldo atualizado com sucesso','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->saldoRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Saldo deletado com sucesso','',204);
    }
}
