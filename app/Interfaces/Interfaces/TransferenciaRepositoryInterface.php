<?php

namespace App\Interfaces\Interfaces;

interface TransferenciaRepositoryInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function verifyExists(array $data);
    public function verifyFounders(array $data);
    public function verifyType(array $data);
    public function verifyAuthorization();
}
