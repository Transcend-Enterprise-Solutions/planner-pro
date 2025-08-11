<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'client',
        'price',
        'date_started',
        'date_end',
        'tor',
        'rfq',
    ];

    protected $casts = [
        'date_started' => 'date',
        'date_end' => 'date',
        'price' => 'decimal:2',
    ];

    /**
     * Get all expenses for the project.
     */
    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'project_id');
    }

    /**
     * Get all personnel for the project.
     */
    public function personnel()
    {
        return $this->hasMany(ProjectPersonel::class, 'project_id');
    }
}
