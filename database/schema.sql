CREATE TABLE usuarios (
    id BIGSERIAL PRIMARY KEY, 
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20)
); 

CREATE TABLE categorias (
    id BIGSERIAL PRIMARY KEY, 
    nome VARCHAR(20)
);

CREATE TABLE chamados (
    id BIGSERIAL PRIMARY KEY,
    solicitante_id BIGINT NOT NULL REFERENCES usuarios(id),
    categoria_id BIGINT NOT NULL REFERENCES categorias(id),
    titulo VARCHAR(120) NOT NULL,
    descricao TEXT NOT NULL,
    prioridade VARCHAR(20) NOT NULL DEFAULT 'Média',
    status VARCHAR(30) NOT NULL DEFAULT 'Pendente de Atendimento',
    criado_em TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT chamados_prioridade_check
        CHECK (prioridade IN ('Baixa', 'Média', 'Alta')),

    CONSTRAINT chamados_status_check
        CHECK (
            status IN (
                'Pendente de Atendimento',
                'Em Atendimento',
                'Cancelado',
                'Resolvido'
            )
        )
);

CREATE TABLE historico_status (
    id BIGSERIAL PRIMARY KEY,
    chamado_id BIGINT NOT NULL REFERENCES chamados (id),
    usuario_id BIGINT NOT NULL REFERENCES usuarios (id),
    status VARCHAR(30) NOT NULL
);

CREATE TABLE comentarios (
    id BIGSERIAL PRIMARY KEY,
    chamado_id BIGINT NOT NULL REFERENCES chamados (id),
    comentario TEXT NOT NULL
);