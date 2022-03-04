<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Department extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'departments_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employees_to_departments');
    }

    public function maxWage()
    {
        return $this->employees();
    }
}
