<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'be_number',
        'fees',
        'type',
        'status',
        'ie_data_id'
    ];
    
    public function ieData()
    {
        return $this->belongsTo(IeData::class);
    }
    
}
