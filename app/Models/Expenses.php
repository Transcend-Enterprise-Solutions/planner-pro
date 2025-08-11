<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'type',
        'amount',
        'expense_for',
        'expense_by',
        'date_released',
        'date_settled',
        'status',
        'remarks',
    ];

    protected $casts = [
        'date_released' => 'date',
        'date_settled' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the project that owns the expense.
     */
    public function project()
    {
        return $this->belongsTo(Projects::class);
    }
}
