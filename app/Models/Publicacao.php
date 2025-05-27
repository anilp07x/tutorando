<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'tipo',
        'conteudo_url',
        'descricao',
        'user_id',
        'aprovado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'aprovado' => 'boolean',
    ];

    /**
     * Get the user that owns the publication.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
