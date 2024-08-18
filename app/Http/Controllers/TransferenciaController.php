<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransferenciaRequest;
use App\Http\Requests\UpdateTransferenciaRequest;
use App\Http\Resources\TransferenciaResource;
use App\Interfaces\Interfaces\TransferenciaRepositoryInterface;
use App\Models\Transferencia;
use App\Classes\ApiResponseClass as ResponseClass;
use Illuminate\Support\Facades\DB;

class TransferenciaController extends Controller
{
    private TransferenciaRepositoryInterface $transferenciaRepositoryInterface;

    public function __construct(TransferenciaRepositoryInterface $transferenciaRepositoryInterface)
    {
        $this->transferenciaRepositoryInterface = $transferenciaRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->transferenciaRepositoryInterface->index();

        return ResponseClass::sendResponse(TransferenciaResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransferenciaRequest $request)
    {
        $details =[
            'value' => $request->value,
            'payer' => $request->payer,
            'payee' => $request->payee,
        ];
        if(!$this->transferenciaRepositoryInterface->verifyType($details)){
            return ResponseClass::errortype();
        }
        if(!$this->transferenciaRepositoryInterface->verifyExists($details))
        {
            return ResponseClass::errorUserNotFound();
        }
        if(!$this->transferenciaRepositoryInterface->verifyFounders($details)){
            return ResponseClass::errorFounders();
        }
        if(!$this->transferenciaRepositoryInterface->verifyAuthorization()){
            return ResponseClass::errorFounders();
        }

        DB::beginTransaction();
        try{
             $transferencia = $this->transferenciaRepositoryInterface->store($details);

             DB::commit();
             return ResponseClass::sendResponse(new TransferenciaResource($transferencia),'Tranferencia feita com sucesso',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transferencia = $this->transferenciaRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new TransferenciaResource($transferencia),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransferenciaRequest $request, $id)
    {
        $updateDetails =[
            'value' => $request->value,
            'payer' => $request->payer,
            'payee' => $request->psayee,
        ];
        DB::beginTransaction();
        try{
             $transferencia = $this->transferenciaRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ResponseClass::sendResponse('Product Update Successful','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transferencia $transferencia)
    {
        //
    }
}
