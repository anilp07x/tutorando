<?php

namespace Database\Seeders;

use App\Models\Instituicao;
use Illuminate\Database\Seeder;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instituicoes = [
            [
                'nome' => 'Universidade de Angola',
                'tipo' => 'superior',
                'localizacao' => 'Luanda, Angola',
            ],
            [
                'nome' => 'Instituto Técnico de Luanda',
                'tipo' => 'técnico',
                'localizacao' => 'Luanda, Angola',
            ],
            [
                'nome' => 'Escola Média de Tecnologia',
                'tipo' => 'médio',
                'localizacao' => 'Benguela, Angola',
            ],
            [
                'nome' => 'Universidade Católica de Angola',
                'tipo' => 'superior',
                'localizacao' => 'Luanda, Angola',
            ],
            [
                'nome' => 'Instituto Superior Técnico',
                'tipo' => 'superior',
                'localizacao' => 'Huambo, Angola',
            ],
        ];

        foreach ($instituicoes as $instituicao) {
            Instituicao::create($instituicao);
        }
    }
}
