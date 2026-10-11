-- Usuários fictícios para teste

INSERT INTO usuarios (nome, telefone)
VALUES 

('Maria Silva', '51999990001'),
('João Santos', '51999990002'),
('Ana Oliveira', '51999990003');

-- Categorias dos chamados
INSERT INTO categorias (nome)
VALUES
('Hardware'),
('Sistema Operacional');

-- Chamados fictícios para teste
INSERT INTO chamados (
    solicitante_id,
    categoria_id,
    titulo,
    descricao,
    prioridade,
    status
)
VALUES
    (7, 5, 'Computador não liga',
     'O computador não liga ao pressionar o botão.',
     'Alta', 'Pendente de Atendimento'),

    (8, 6, 'Problema no sistema operacional',
     'O sistema operacional apresenta erros ao iniciar.',
     'Média', 'Em Atendimento'),

    (9, 5, 'Teclado não funciona',
     'O teclado não responde ao digitar.',
     'Baixa', 'Resolvido'),

    (7, 6, 'Computador lento',
     'O computador está muito lento ao abrir programas.',
     'Média', 'Cancelado');