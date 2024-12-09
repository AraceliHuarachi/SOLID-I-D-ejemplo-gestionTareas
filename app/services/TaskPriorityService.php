<?php

namespace App\Services;

use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;

class TaskPriorityService implements TaskPriorityInterface
{
    public function setPriority(Task $task, string $priority): Task
    {
        $task->priority = $priority;
        $task->save();
        return $task;
    }

    public function autoAssignPriority(Task $task): Task
    {
        $currentDate = now()->startOfDay();
        $deadline = \Carbon\Carbon::parse($task->deadline)->startOfDay();

        $diffInDays = $currentDate->diffInDays($deadline);

        // @todo . Eliminar numeros sin definicion (sin sentido)  y agregar comentarios.


        //Definicion del rango de dias para los tipos de prioridades:
        $daysHigh = 7; //una semana o menos para entregar
        $daysMedium = 30; // un mes o menos para entregar
        $daysLow = 90; // Tres meses o menos para entregar

        if ($diffInDays <= $daysHigh) {
            $this->setPriority($task, 'high');
        } elseif ($diffInDays <= $daysMedium) {
            $this->setPriority($task, 'medium');
        } elseif ($diffInDays <= $daysLow) {
            $this->setPriority($task, 'low');
        }
        return $task;
    }
}
