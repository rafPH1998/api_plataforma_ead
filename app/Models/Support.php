<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $fillable = ['description', 'status', 'lesson_id'];

    public $statusOptions = [
        'P' => 'Pendente, aguardando professor',
        'A' => 'Aguardando Aluno',
        'C' => 'Finalizado',
    ];

    //retornando o usuario do suporte
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //retornando o aula do suporte
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    //trazendo todas as repostas de um suporte
    public function replies()
    {
        return $this->hasMany(ReplySupport::class);
    }
}
