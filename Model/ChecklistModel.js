const db = require('../config/database');

class ChecklistModel {

    
    static async criar(id_usuario, data_criacao) {
        try {
            
            const existe = await this.buscarPorData(id_usuario, data_criacao);
            if (existe) return existe.id_checklist;

            const query = `INSERT INTO checklists (id_usuario, data_criacao) VALUES (?, ?)`;
            const [resultado] = await db.execute(query, [id_usuario, data_criacao]);
            
            return resultado.insertId;
        } catch (erro) {
            console.error("Erro ao criar checklist:", erro);
            throw erro;
        }
    }

    
    static async buscarPorData(id_usuario, data) {
        try {
            const query = `SELECT * FROM checklists WHERE id_usuario = ? AND data_criacao = ?`;
            const [linhas] = await db.execute(query, [id_usuario, data]);
            return linhas[0];
        } catch (erro) {
            console.error("Erro ao buscar checklist por data:", erro);
            throw erro;
        }
    }

    
    static async listarHistorico(id_usuario) {
        try {
            const query = `
                SELECT * FROM checklists 
                WHERE id_usuario = ? 
                ORDER BY data_criacao DESC
            `;
            const [linhas] = await db.execute(query, [id_usuario]);
            return linhas;
        } catch (erro) {
            console.error("Erro ao listar histórico de checklists:", erro);
            throw erro;
        }
    }

    
    static async eliminar(id_checklist, id_usuario) {
        try {
            const query = `DELETE FROM checklists WHERE id_checklist = ? AND id_usuario = ?`;
            const [resultado] = await db.execute(query, [id_checklist, id_usuario]);
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao eliminar checklist:", erro);
            throw erro;
        }
    }
}

module.exports = ChecklistModel;