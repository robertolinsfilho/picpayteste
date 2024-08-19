<?php

namespace Tests\Unit\Repository;

use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Tests\TestCase;

class UsuarioRepositoryTest extends TestCase
{

    public function testUsuarioIndex(): void
    {
        $company = Usuario::newFactory([
            'nome' => 'robertooooo',
            'email' => 'rlins74@gmail.com',
            'cpf' => '11068969474',
            'senha' => 'senha',
            'tipo' => 1,
        ]);

        $response = (new UsuarioRepository($company))->index();

        $this->assertNotEmpty($response);
    }

    public function testUsuarioGetById(): void
    {

        $response = (new UsuarioRepository())->getById(4);

        $this->assertNotEmpty($response);

    }

}
