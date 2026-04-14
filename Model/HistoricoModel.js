const db = require('../config/database');

class HistoricoModel {

    
    static async registrarConclusao(id_atividade, id_usuario) {
        try {
            const query = `
                INSERT INTO historico_conclusoes (id_atividade, id_usuario, data_registro) 
                VALUES (?, ?, CURRENT_TIMESTAMP)
            `;
            const [resultado] = await db.execute(query, [id_atividade, id_usuario]);
            return resultado.insertId;
        } catch (erro) {
            console.error("Erro ao registrar conclusão no histórico:", erro);
            throw erro;
        }
    }

    
    static async buscarPorUsuario(id_usuario) {
        try {
            const query = `
                SELECT h.id_historico, h.data_registro, a.nome as nome_atividade, a.tipo
                FROM historico_conclusoes h
                INNER JOIN atividades a ON h.id_atividade = a.id_atividade
                WHERE h.id_usuario = ?
                ORDER BY h.data_registro DESC
            `;
            const [linhas] = await db.execute(query, [id_usuario]);
            return linhas;
        } catch (erro) {
            console.error("Erro ao buscar histórico do usuário:", erro);
            throw erro;
        }
    }

    
    static async removerRegistro(id_atividade, id_usuario) {
        try {
            const query = `
                DELETE FROM historico_conclusoes 
                WHERE id_atividade = ? AND id_usuario = ?
            `;
            const [resultado] = await db.execute(query, [id_atividade, id_usuario]);
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao remover registro do histórico:", erro);
            throw erro;
        }
    }

    
    static async contarConcluidas(id_usuario) {
        try {
            const query = `SELECT COUNT(*) as total FROM historico_conclusoes WHERE id_usuario = ?`;
            const [linhas] = await db.execute(query, [id_usuario]);
            return linhas[0].total;
        } catch (erro) {
            console.error("Erro ao contar tarefas concluídas:", erro);
            throw erro;
        }
    }
}

module.exports = HistoricoModel;