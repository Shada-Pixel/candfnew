<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ain_no',
        'name',
        'bangla_name',
        'license_no',
        'license_issue_date',
        'membership_no',
        'agency_logo',
        'owners_name',
        'owners_gender',
        'owner_photo',
        'owners_designation',
        'office_address',
        'phone',
        'email',
        'house',
        'parmanent_address',
        'note'
    ];

    public function donations() {
        return $this->hasMany(Donation::class)->orderBy('id', 'desc');
    }

}
