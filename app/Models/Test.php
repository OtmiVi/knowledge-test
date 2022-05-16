<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'discipline_id',
    ];

    public function questions(){
        return $this->hasMany(TestQuestion::class);
    }

    public function discipline(){
        return $this->belongsTo(Discipline::class);
    }

}
