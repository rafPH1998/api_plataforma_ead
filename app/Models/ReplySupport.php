<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'support_id',
        'user_id'
    ];

    protected $table = 'reply_support';
    
    protected $touches = ['support'];

    //trazendo a qual support pertence a resposta
    public function support()
    {
        return $this->belongsTo(Support::class);
    }

    //trazendo o usuario a quem pertence a resposta
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
