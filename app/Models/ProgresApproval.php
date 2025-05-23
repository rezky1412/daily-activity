<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'progres_id',
        'approved_by',
        'role',
        'status',
        'comment',
        'qr_code',
    ];

    public function progres()
    {
        return $this->belongsTo(Progres::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
