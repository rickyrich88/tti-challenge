<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'status'];

    use HasFactory;

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
