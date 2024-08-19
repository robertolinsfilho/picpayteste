<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Classes\ApiResponseClass as ResponseClass;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UsuarioResource;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Interfaces\UsuarioRepositoryInterface;

class UsuarioController extends Controller
{
    private UsuarioRepositoryInterface $usuarioRepositoryInterface;

    public function __construct(UsuarioRepositoryInterface $usuarioRepositoryInterface)
    {
        $this->usuarioRepositoryInterface = $usuarioRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->usuarioRepositoryInterface->index();

        return ResponseClass::sendResponse(UsuarioResource::collection($data),'',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        $details =[
            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => $request->senha,
            'tipo' => $request->tipo,
        ];

        DB::beginTransaction();

        try{

             $usuario = $this->usuarioRepositoryInterface->store($details);

             DB::commit();

             return ResponseClass::sendResponse(new UsuarioResource($usuario),'Usuario criado com sucesso',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = $this->usuarioRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new UsuarioResource($usuario),'',200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, $id)
    {
        $updateDetails =[
            'nome' => $request->nome,
            'tipo' => $request->tipo
        ];
        DB::beginTransaction();
        try{
             $usuario = $this->usuarioRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ResponseClass::sendResponse('Usuario Update Successful','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->usuarioRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Product Delete Successful','',204);
    }
}
