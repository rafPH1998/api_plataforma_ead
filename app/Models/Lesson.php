<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'video',
        'module_id',
        'name',
        'url',
    ];

     //retornando todos os suports de uma determinada aula
     public function supports()
     {
         return $this->hasMany(Support::class);
     }
    
}
