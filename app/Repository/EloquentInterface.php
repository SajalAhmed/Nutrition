<?php


namespace App\Repository;


interface EloquentInterface
{
    public function all();

    public function create($data);

    public function findById($id);

    public function update($data, $id);

    public function control($id);

    public function delete($id);
}
