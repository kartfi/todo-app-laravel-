<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These come from the HTML form (title and description).
     * 'status' is included so the toggle button can update it.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
    ];
}
