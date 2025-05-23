<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'project_id', 
        'date', 
        'percent', 
        'notes', 
        'evidence', 
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function approvals()
    {
        return $this->hasMany(ProgresApproval::class)->latest();
    }
}
