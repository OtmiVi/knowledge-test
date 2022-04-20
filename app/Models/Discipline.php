<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'discipline_users');
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'discipline_groups');
    }

    public function tests(){
        return $this->hasMany(Test::class);
    }
}
