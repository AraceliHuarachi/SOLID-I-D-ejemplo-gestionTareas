<?php

namespace App\Services;

use App\Interfaces\TaskPriorityInterface;
use App\Models\Task;

class AriPriorityService implements TaskPriorityInterface
{
    //Asignacion manual de prioridad a una tarea.
    public function setPriority(Task $task, string $priority): Task
    {
        $task->priority = $priority;
        $task->save();
        return $task;
    }

    //Asignacion automatica de prioridad a una tarea,
    public function autoAssignPriority(Task $task): Task
    {
        $currentDate = now()->startOfDay();
        $deadline = \Carbon\Carbon::parse($task->deadline)->startOfDay();

        // calculo de la diferencia de dias entre la fecha de creacion de la tarea y la fecha limite.
        $diffInDays = $currentDate->diffInDays($deadline);

        //Definicion del rango de dias para los tipos de prioridades:
        $daysUrgent = 2; //dos dias o menos para entregar
        $daysHight = 7; //una semana o menos para entregar
        $daysMedium = 30; // un mes o menos para entregar
        $daysLow = 90; // Tres meses o menos para entregar
        $daysVeryLow = 365; //Un año o menos para entregar 

        if ($diffInDays <= $daysUrgent) {
            $this->setPriority($task, 'urgent');
        } elseif ($diffInDays <= $daysHight) {
            $this->setPriority($task, 'high');
        } elseif ($diffInDays <= $daysMedium) {
            $this->setPriority($task, 'medium');
        } elseif ($diffInDays <= $daysLow) {
            $this->setPriority($task, 'low');
        } elseif ($diffInDays <= $daysVeryLow) {
            $this->setPriority($task, 'veryLow');
        }


        return $task;
    }
}
