<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Instituicao;
use App\Models\Projeto;
use App\Models\Publicacao;
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
        // Call the institution seeder
        $this->call(InstituicaoSeeder::class);
        
        // Get first institution ID for users who need an institution
        $firstInstitutionId = Instituicao::first()->id;
        
        // Create admin user
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@tutorando.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'curso' => 'Administração',
            'instituicao_id' => $firstInstitutionId,
        ]);
        
        // Create sample tutors
        $tutores = [
            [
                'name' => 'João Silva',
                'email' => 'joao@tutorando.com',
                'password' => Hash::make('password'),
                'role' => 'tutor',
                'curso' => 'Engenharia Informática',
                'instituicao_id' => $firstInstitutionId,
            ],
            [
                'name' => 'Maria Sousa',
                'email' => 'maria@tutorando.com',
                'password' => Hash::make('password'),
                'role' => 'tutor',
                'curso' => 'Ciências da Educação',
                'instituicao_id' => $firstInstitutionId,
            ],
        ];
        
        foreach ($tutores as $tutor) {
            User::factory()->create($tutor);
        }
        
        // Create sample tutorandos
        $tutorandos = [
            [
                'name' => 'Pedro Santos',
                'email' => 'pedro@example.com',
                'password' => Hash::make('password'),
                'role' => 'tutorando',
                'curso' => 'Engenharia Informática',
                'instituicao_id' => $firstInstitutionId,
            ],
            [
                'name' => 'Ana Costa',
                'email' => 'ana@example.com',
                'password' => Hash::make('password'),
                'role' => 'tutorando',
                'curso' => 'Medicina',
                'instituicao_id' => $firstInstitutionId,
            ],
        ];
        
        foreach ($tutorandos as $tutorando) {
            User::factory()->create($tutorando);
        }
        
        // Create sample projects
        $tutor1 = User::where('email', 'joao@tutorando.com')->first();
        $tutorando1 = User::where('email', 'pedro@example.com')->first();
        
        $projetos = [
            [
                'titulo' => 'Sistema de Gestão Académica',
                'descricao' => 'Projeto para desenvolver um sistema de gestão académica para instituições de ensino.',
                'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'user_id' => $tutor1->id,
                'aprovado' => true,
            ],
            [
                'titulo' => 'Aplicativo de Monitoramento de Saúde',
                'descricao' => 'Desenvolvimento de um aplicativo para monitoramento de saúde dos pacientes.',
                'user_id' => $tutorando1->id,
                'aprovado' => false,
            ],
        ];
        
        foreach ($projetos as $projeto) {
            Projeto::create($projeto);
        }
        
        // Create sample publications (only for tutors)
        $publicacoes = [
            [
                'titulo' => 'Introdução à Programação em Python',
                'descricao' => 'Material didático sobre programação básica em Python.',
                'tipo' => 'sebenta',
                'conteudo_url' => 'publicacoes/sebenta/python_intro.pdf',
                'user_id' => $tutor1->id,
                'aprovado' => true,
            ],
            [
                'titulo' => 'Metodologias de Ensino Modernas',
                'descricao' => 'Artigo sobre metodologias de ensino para o século XXI.',
                'tipo' => 'artigo',
                'conteudo_url' => 'https://example.com/artigo-metodologias',
                'user_id' => User::where('email', 'maria@tutorando.com')->first()->id,
                'aprovado' => true,
            ],
        ];
        
        foreach ($publicacoes as $publicacao) {
            Publicacao::create($publicacao);
        }
    }
}
