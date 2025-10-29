<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'role_level',
        'first_name',
        'middle_name',
        'last_name',
        'username',
        'email',
        'contact_number',
        'password',
        'created_at',
        'updated_at'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'dentist_id');
    }

    public function fullname()
    {
        $middle = $this->middle_name ? " {$this->middle_name} " : " ";
        return "{$this->first_name}{$middle}{$this->last_name}";
    }
}
