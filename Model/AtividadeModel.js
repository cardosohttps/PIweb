const db = require('../config/database');

class AtividadeModel {

    
    static async criar(dados) {
        try {
            const { id_usuario, nome, tipo, descricao, data_registro, id_checklist, id_sugestao } = dados;
            
            const query = `
                INSERT INTO atividades (id_usuario, nome, tipo, descricao, data_registro, id_checklist, id_sugestao)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            `;

            const [resultado] = await db.execute(query, [
                id_usuario, 
                nome, 
                tipo, 
                descricao || null, 
                data_registro, 
                id_checklist || null, 
                id_sugestao || null
            ]);

            return resultado.insertId;
        } catch (erro) {
            console.error("Erro ao criar atividade:", erro);
            throw erro;
        }
    }

    
    static async buscarPorUsuarioEData(id_usuario, data) {
        try {
            const query = `
                SELECT * FROM atividades 
                WHERE id_usuario = ? AND data_registro = ?
                ORDER BY tipo, id_atividade ASC
            `;
            const [linhas] = await db.execute(query, [id_usuario, data]);
            return linhas;
        } catch (erro) {
            console.error("Erro ao buscar atividades:", erro);
            throw erro;
        }
    }

    
    static async atualizarStatus(id_atividade, concluida) {
        try {
            const query = `
                UPDATE atividades 
                SET concluida = ? 
                WHERE id_atividade = ?
            `;
            
            const [resultado] = await db.execute(query, [concluida ? 1 : 0, id_atividade]);
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao atualizar status da atividade:", erro);
            throw erro;
        }
    }

    
    static async eliminar(id_atividade, id_usuario) {
        try {
            
            const query = `DELETE FROM atividades WHERE id_atividade = ? AND id_usuario = ?`;
            const [resultado] = await db.execute(query, [id_atividade, id_usuario]);
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao eliminar atividade:", erro);
            throw erro;
        }
    }

    
    static async buscarPorId(id_atividade) {
        try {
            const query = `SELECT * FROM atividades WHERE id_atividade = ?`;
            const [linhas] = await db.execute(query, [id_atividade]);
            return linhas[0];
        } catch (erro) {
            console.error("Erro ao buscar detalhes da atividade:", erro);
            throw erro;
        }
    }
}

module.exports = AtividadeModel;