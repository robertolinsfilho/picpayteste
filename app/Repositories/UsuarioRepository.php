<?php

namespace App\Repositories;

use App\Models\Usuario;
use App\Interfaces\UsuarioRepositoryInterface;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    public function index()
    {
        return Usuario::all();
    }

    public function getById($id)
    {
        return Usuario::findOrFail($id);
    }

    public function store(array $data)
    {
        return Usuario::create($data);
    }

    public function update(array $data, $id)
    {
        return Usuario::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Usuario::destroy($id);
    }
}
