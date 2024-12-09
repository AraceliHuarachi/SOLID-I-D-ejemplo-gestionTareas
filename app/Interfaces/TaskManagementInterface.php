<?php

namespace App\Interfaces;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskManagementInterface
{
    //Estos metodos se encargan de la GESTION de tareas:
    public function createTask(array $data): Task;
    public function updateTask(int $id, array $data): Task;
    public function deleteTask(int $id): bool;

    //Si implementamos un metodo para CONSULTAS se romperia el principio ISP. 
    public function getAllTasks(): Collection;
    //Otro metodo que romperia el principio ISP:
    //public function getTaskById(int $id): Task;
}
