<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Instituicao;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar usuário administrador
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@tutorando.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Criar algumas instituições
        $instituicoes = [
            ['nome' => 'Universidade de Angola', 'tipo' => 'superior', 'localizacao' => 'Luanda, Angola'],
            ['nome' => 'Instituto Politécnico de Maputo', 'tipo' => 'superior', 'localizacao' => 'Maputo, Moçambique'],
            ['nome' => 'Escola Técnica de Informática', 'tipo' => 'tecnico', 'localizacao' => 'Luanda, Angola'],
            ['nome' => 'Colégio São Francisco', 'tipo' => 'medio', 'localizacao' => 'Benguela, Angola'],
        ];

        foreach ($instituicoes as $instituicao) {
            Instituicao::create($instituicao);
        }
    }
}
