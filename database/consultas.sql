-- 1. Listar chamados pendentes de atendimento
SELECT *
FROM chamados
WHERE status = 'Pendente de Atendimento'; 

SELECT * 
FROM chamados 
WHERE status = 'Em Atendimento'; 

SELECT * 
FROM prioridade
WHERE status = 'Alta';

SELECT *
FROM chamados
WHERE prioridade = 'Baixa';

SELECT 
chamados.solicitante_id,
chamados.categoria_id
FROM chamados;

SELECT COUNT(*)
FROM chamados;

SELECT status, COUNT(*) AS total
FROM chamados
GROUP BY status
ORDER BY total DESC;

SELECT status, COUNT(*) AS total 
FROM categorias 
GROUP BY status 
ORDER BY total DESC; 

SELECT categorias.nome, COUNT(*) AS total
FROM chamados
JOIN categorias ON chamados.categoria_id = categorias.id
GROUP BY categorias.nome
ORDER BY total DESC;

SELECT *
FROM chamados
WHERE criado_em >= '2026-10-01'
AND criado_em < '2026-11-01';

SELECT *
FROM comentarios
WHERE chamado_id = 1;

SELECT *
FROM historico_status
WHERE chamado_id = 1;