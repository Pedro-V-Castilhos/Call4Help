<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name'])]
class Sector extends Model
{
    use HasFactory;
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
