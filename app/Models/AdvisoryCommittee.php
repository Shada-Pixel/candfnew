<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvisoryCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'photo',
        'order',
        'active',
        'type'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
