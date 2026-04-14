const db = require('../config/database');

class RecompensaModel {

    
    static async listarTodas() {
        try {
            const query = `SELECT * FROM recompensas ORDER BY nivel_necessario ASC`;
            const [linhas] = await db.execute(query);
            return linhas;
        } catch (erro) {
            console.error("Erro ao listar recompensas:", erro);
            throw erro;
        }
    }

    
    static async buscarPorUsuario(id_usuario) {
        try {
            const query = `
                SELECT r.*, ur.data_desbloqueio 
                FROM recompensas r
                INNER JOIN usuario_recompensa ur ON r.id_recompensa = ur.id_recompensa
                WHERE ur.id_usuario = ?
                ORDER BY ur.data_desbloqueio DESC
            `;
            const [linhas] = await db.execute(query, [id_usuario]);
            return linhas;
        } catch (erro) {
            console.error("Erro ao buscar conquistas do usuário:", erro);
            throw erro;
        }
    }

    
    static async registrarConquista(id_usuario, id_recompensa) {
        try {
            
            const query = `
                INSERT IGNORE INTO usuario_recompensa (id_usuario, id_recompensa, data_desbloqueio) 
                VALUES (?, ?, CURRENT_TIMESTAMP)
            `;
            const [resultado] = await db.execute(query, [id_usuario, id_recompensa]);
            
            
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao registrar conquista:", erro);
            throw erro;
        }
    }

    
    static async jaPossui(id_usuario, id_recompensa) {
        try {
            const query = `
                SELECT 1 FROM usuario_recompensa 
                WHERE id_usuario = ? AND id_recompensa = ?
            `;
            const [linhas] = await db.execute(query, [id_usuario, id_recompensa]);
            return linhas.length > 0;
        } catch (erro) {
            console.error("Erro ao verificar posse de recompensa:", erro);
            throw erro;
        }
    }
}

module.exports = RecompensaModel;