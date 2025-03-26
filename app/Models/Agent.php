<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable=[
        'ain_no',
        'name',
        'owners_name',
        'photo',
        'destination',
        'office_address',
        'phone',
        'email',
        'house',
        'note'
    ];


    public function donations(){
        return $this->hasMany(Donation::class)->orderBy('id', 'desc');
    }

}
