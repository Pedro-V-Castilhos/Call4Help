<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['status', 'title', 'content', 'sector_id', 'attachment_url', 'priority_id', 'worker_id', 'user_id', 'solution_message'])]
class Call extends Model
{
    use HasFactory;
    protected $casts = [
        'closed_at' => 'datetime',
        'opened_at' => 'datetime',
    ];
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
