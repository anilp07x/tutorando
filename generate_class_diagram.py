#!/usr/bin/env python3
"""
Gerador de Diagrama de Classes para o Projeto Tutorando
Este script cria um diagrama UML das classes principais do sistema.
"""

import matplotlib.pyplot as plt
import matplotlib.patches as patches
from matplotlib.patches import FancyBboxPatch
import numpy as np

def create_class_diagram():
    """Cria o diagrama de classes do projeto Tutorando"""
    
    # Configurar a figura
    fig, ax = plt.subplots(1, 1, figsize=(16, 12))
    ax.set_xlim(0, 16)
    ax.set_ylim(0, 12)
    ax.axis('off')
    
    # Cores
    class_color = '#E3F2FD'
    header_color = '#1976D2'
    text_color = '#000000'
    relation_color = '#666666'
    
    # Função para criar uma caixa de classe
    def create_class_box(x, y, width, height, class_name, attributes, methods, ax):
        # Caixa principal
        box = FancyBboxPatch(
            (x, y), width, height,
            boxstyle="round,pad=0.02",
            facecolor=class_color,
            edgecolor='black',
            linewidth=1.5
        )
        ax.add_patch(box)
        
        # Header da classe
        header = FancyBboxPatch(
            (x, y + height - 0.8), width, 0.8,
            boxstyle="round,pad=0.02",
            facecolor=header_color,
            edgecolor='black',
            linewidth=1.5
        )
        ax.add_patch(header)
        
        # Nome da classe
        ax.text(x + width/2, y + height - 0.4, class_name, 
                ha='center', va='center', fontsize=12, fontweight='bold', color='white')
        
        # Atributos
        attr_y = y + height - 1.2
        for attr in attributes:
            ax.text(x + 0.1, attr_y, f"• {attr}", ha='left', va='top', fontsize=9, color=text_color)
            attr_y -= 0.3
        
        # Linha separadora
        ax.plot([x + 0.1, x + width - 0.1], [attr_y + 0.1, attr_y + 0.1], 
                color='black', linewidth=0.5)
        
        # Métodos
        method_y = attr_y - 0.1
        for method in methods:
            ax.text(x + 0.1, method_y, f"• {method}", ha='left', va='top', fontsize=9, color=text_color)
            method_y -= 0.3
    
    # Definir as classes e suas propriedades
    classes = {
        'User': {
            'position': (1, 7),
            'size': (3.5, 4),
            'attributes': [
                'id: int',
                'name: string',
                'email: string',
                'password: string',
                'role: string',
                'curso: string',
                'instituicao_id: int',
                'email_verified_at: datetime',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'instituicao()',
                'projetos()',
                'publicacoes()',
                'plano()',
                'isAdmin()',
                'isTutor()',
                'isTutorando()'
            ]
        },
        'Instituicao': {
            'position': (6, 9),
            'size': (3, 2.5),
            'attributes': [
                'id: int',
                'nome: string',
                'tipo: string',
                'localizacao: string',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'users()'
            ]
        },
        'Publicacao': {
            'position': (10.5, 7),
            'size': (3.5, 3.5),
            'attributes': [
                'id: int',
                'titulo: string',
                'tipo: string',
                'conteudo_url: string',
                'descricao: text',
                'user_id: int',
                'aprovado: boolean',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'user()'
            ]
        },
        'Projeto': {
            'position': (10.5, 3),
            'size': (3.5, 3.5),
            'attributes': [
                'id: int',
                'titulo: string',
                'descricao: text',
                'imagens: array',
                'youtube_link: string',
                'arquivo_pdf: string',
                'user_id: int',
                'aprovado: boolean',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'user()'
            ]
        },
        'PlanoUser': {
            'position': (6, 4.5),
            'size': (3, 3),
            'attributes': [
                'id: int',
                'user_id: int',
                'tipo_plano: string',
                'valor_pago: decimal',
                'data_expiracao: date',
                'status: string',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'user()'
            ]
        },
        'AuditLog': {
            'position': (1, 1),
            'size': (4, 4),
            'attributes': [
                'id: int',
                'admin_user_id: int',
                'admin_user_name: string',
                'action: string',
                'resource_type: string',
                'resource_id: int',
                'resource_title: string',
                'affected_count: int',
                'metadata: array',
                'ip_address: string',
                'user_agent: string',
                'created_at: datetime',
                'updated_at: datetime'
            ],
            'methods': [
                'adminUser()',
                'createLog()'
            ]
        }
    }
    
    # Criar as caixas das classes
    for class_name, class_info in classes.items():
        x, y = class_info['position']
        width, height = class_info['size']
        create_class_box(x, y, width, height, class_name, 
                        class_info['attributes'], class_info['methods'], ax)
    
    # Função para desenhar relacionamentos
    def draw_relationship(start_pos, end_pos, label, relationship_type='association'):
        start_x, start_y = start_pos
        end_x, end_y = end_pos
        
        # Desenhar linha
        ax.annotate('', xy=(end_x, end_y), xytext=(start_x, start_y),
                   arrowprops=dict(arrowstyle='->', color=relation_color, lw=1.5))
        
        # Adicionar label no meio da linha
        mid_x = (start_x + end_x) / 2
        mid_y = (start_y + end_y) / 2
        ax.text(mid_x, mid_y, label, ha='center', va='bottom', 
               fontsize=8, color=relation_color, 
               bbox=dict(boxstyle="round,pad=0.2", facecolor='white', alpha=0.8))
    
    # Desenhar relacionamentos
    relationships = [
        # User -> Instituicao (belongsTo)
        ((4.5, 9), (6, 10), 'belongsTo'),
        
        # User -> Publicacao (hasMany)
        ((4.5, 8.5), (10.5, 8.5), 'hasMany'),
        
        # User -> Projeto (hasMany)
        ((4.5, 8), (10.5, 5), 'hasMany'),
        
        # User -> PlanoUser (hasOne)
        ((4.5, 7.5), (6, 6), 'hasOne'),
        
        # User -> AuditLog (hasMany)
        ((2.75, 7), (2.75, 5), 'hasMany'),
        
        # Instituicao -> User (hasMany)
        ((6, 9.8), (4.5, 9.8), 'hasMany'),
    ]
    
    for start, end, label in relationships:
        draw_relationship(start, end, label)
    
    # Título
    ax.text(8, 11.5, 'Diagrama de Classes - Projeto Tutorando', 
           ha='center', va='center', fontsize=18, fontweight='bold')
    
    # Legenda
    legend_y = 0.5
    ax.text(12, legend_y + 0.3, 'Legenda:', fontsize=12, fontweight='bold')
    ax.text(12, legend_y, '• belongsTo: Relacionamento N:1', fontsize=10)
    ax.text(12, legend_y - 0.2, '• hasMany: Relacionamento 1:N', fontsize=10)
    ax.text(12, legend_y - 0.4, '• hasOne: Relacionamento 1:1', fontsize=10)
    
    plt.tight_layout()
    return fig

def save_diagram():
    """Salva o diagrama em diferentes formatos"""
    fig = create_class_diagram()
    
    # Salvar como PNG (alta qualidade)
    fig.savefig('diagrama_classes_tutorando.png', dpi=300, bbox_inches='tight', 
                facecolor='white', edgecolor='none')
    
    # Salvar como PDF
    fig.savefig('diagrama_classes_tutorando.pdf', bbox_inches='tight', 
                facecolor='white', edgecolor='none')
    
    # Salvar como JPG
    fig.savefig('diagrama_classes_tutorando.jpg', dpi=300, bbox_inches='tight', 
                facecolor='white', edgecolor='none')
    
    plt.close(fig)
    
    print("✅ Diagrama de classes gerado com sucesso!")
    print("📁 Arquivos criados:")
    print("   • diagrama_classes_tutorando.png")
    print("   • diagrama_classes_tutorando.pdf") 
    print("   • diagrama_classes_tutorando.jpg")

if __name__ == "__main__":
    try:
        save_diagram()
    except ImportError as e:
        print("❌ Erro: Biblioteca necessária não encontrada.")
        print("💡 Execute: pip install matplotlib")
        print(f"Erro específico: {e}")
    except Exception as e:
        print(f"❌ Erro inesperado: {e}")