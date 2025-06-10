<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'curso',
        'instituicao_id',
        'bio',
        'telefone',
        'pais',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the institution that the user belongs to.
     */
    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }

    /**
     * Get the projects that belong to the user.
     */
    public function projetos()
    {
        return $this->hasMany(Projeto::class);
    }

    /**
     * Get the publications that belong to the user.
     */
    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class);
    }

    /**
     * Get the plan that belongs to the user.
     */
    public function plano()
    {
        return $this->hasOne(PlanoUser::class);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a tutor.
     */
    public function isTutor()
    {
        return $this->role === 'tutor';
    }

    /**
     * Check if the user is a tutorando.
     */
    public function isTutorando()
    {
        return $this->role === 'tutorando';
    }
}
