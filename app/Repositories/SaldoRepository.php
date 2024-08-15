<?php

namespace App\Repositories;

use App\Interfaces\Interfaces\SaldoRepositoryInterface;
use App\Models\Saldo;

class SaldoRepository implements SaldoRepositoryInterface
{
        public function index(){
            return Saldo::all();
        }

        public function getById($id){
           return Saldo::findOrFail($id);
        }

        public function store(array $data){
           return Saldo::create($data);
        }

        public function update(array $data,$id){
           return Saldo::whereId($id)->update($data);
        }

        public function delete($id){
            Saldo::destroy($id);
        }
}
