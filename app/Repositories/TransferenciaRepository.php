<?php

namespace App\Repositories;

use Exception;
use App\Models\Saldo;
use App\Models\Usuario;
use App\Models\Transferencia;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Interfaces\TransferenciaRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;

class TransferenciaRepository implements TransferenciaRepositoryInterface
{
    public function index()
    {
        return Transferencia::all();
    }

    public function getById($id)
    {
        return Transferencia::findOrFail($id);
    }

    public function store(array $data)
    {
        $usuarioPayer =  Usuario::findOrFail($data['payer']);
        $usuarioPayee =  Usuario::findOrFail($data['payee']);

        $saldoPayer = DB::table('saldos')->where('id_usuario', $usuarioPayer['id'])->first();
        $saldoPayee = DB::table('saldos')->where('id_usuario', $usuarioPayee['id'])->first();


        if($saldoPayer === null){
            DB::table('saldos')->insert(["id_usuario" => $usuarioPayer['id'], "saldo" => "0.00","created_at"=> Carbon::now(),"updated_at"=> Carbon::now()]);
        }
        if($saldoPayee === null){
            DB::table('saldos')->insert(["id_usuario" => $usuarioPayee['id'], "saldo" => "0.00","created_at"=> Carbon::now(),"updated_at"=> Carbon::now()]);
        }

        $saldoPayer = DB::table('saldos')->where('id_usuario', $usuarioPayer['id'])->first();
        $saldoPayee = DB::table('saldos')->where('id_usuario', $usuarioPayee['id'])->first();


        $saldoTotalPayer = $saldoPayer->saldo - $data['value'];
        $saldoTotalPayee = $saldoPayee->saldo + $data['value'];
        DB::table('saldos')->where('id_usuario', $usuarioPayer['id'])->update(['saldo' => $saldoTotalPayer]);
        DB::table('saldos')->where('id_usuario', $usuarioPayee['id'])->update(['saldo' => $saldoTotalPayee]);
        return Transferencia::create($data);
    }

    public function update(array $data, $id)
    {
        return Transferencia::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Transferencia::destroy($id);
    }

    public function verifyExists(array $data)
    {
        try {
            Usuario::findOrFail($data['payer'])->count();
            Usuario::findOrFail($data['payee'])->count();
            return true;
        } catch(Exception $ex) {
            return false;
        }
    }

    public function verifyFounders(array $data)
    {
        $usuario =  Usuario::findOrFail($data['payer']);
        $saldo = DB::table('saldos')->where('id_usuario', $usuario['id'])->first();

        if($data['value'] < $saldo->saldo) {
            return true;
        }
        return false;
    }
    public function verifyType(array $data)
    {
        $usuario =  Usuario::findOrFail($data['payer']);

        if($usuario['tipo'] > 1) {
            return false;
        }
        return true;
    }
    public function verifyAuthorization(){
        $client = new Client();

        $apiUrl = "https://util.devi.tools/api/v2/authorize";
        try {
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody(), true);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
