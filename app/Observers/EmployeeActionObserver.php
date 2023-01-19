<?php

namespace App\Observers;

use App\Models\Employee;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class EmployeeActionObserver
{
    public function created(Employee $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Employee'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Employee $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Employee'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
