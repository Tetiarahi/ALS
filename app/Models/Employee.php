<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'status' => 'Married',
        'jhj'    => 'Single',
        'hj'     => 'Divorced',
        'lk'     => 'widowed',
    ];

    public $table = 'employees';

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'surmane',
        'dob',
        'status',
        'emp_qua_id',
        'workstatus_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();
        Employee::observe(new \App\Observers\EmployeeActionObserver());
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function emp_qua()
    {
        return $this->belongsTo(Qualification::class, 'emp_qua_id');
    }

    public function workstatus()
    {
        return $this->belongsTo(EmpWorkStatus::class, 'workstatus_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
