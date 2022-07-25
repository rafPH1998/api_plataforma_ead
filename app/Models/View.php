<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'lesson_id', 'qtd'];

    //retornando a qual usuario pertence que esta sendo visualizada
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //retornando a qual aula pertence que esta sendo visualizada
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
