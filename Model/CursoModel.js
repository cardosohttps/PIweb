const db = require('../config/database');

class CursoModel {

    
    static async listarTodos() {
        try {
            const query = `SELECT * FROM cursos ORDER BY nome ASC`;
            const [linhas] = await db.execute(query);
            return linhas;
        } catch (erro) {
            console.error("Erro ao listar cursos:", erro);
            throw erro;
        }
    }

    
    static async buscarPorId(id_curso) {
        try {
            const query = `SELECT * FROM cursos WHERE id_curso = ?`;
            const [linhas] = await db.execute(query, [id_curso]);
            return linhas[0];
        } catch (erro) {
            console.error("Erro ao buscar curso:", erro);
            throw erro;
        }
    }

    
    static async buscarSugestoesPorCurso(id_curso) {
        try {
            const query = `
                SELECT * FROM sugestoes_atividades 
                WHERE id_curso = ? 
                ORDER BY nome ASC
            `;
            const [linhas] = await db.execute(query, [id_curso]);
            return linhas;
        } catch (erro) {
            console.error("Erro ao buscar sugestões do curso:", erro);
            throw erro;
        }
    }

    
    static async criar(nome, area) {
        try {
            const query = `INSERT INTO cursos (nome, area) VALUES (?, ?)`;
            const [resultado] = await db.execute(query, [nome, area]);
            return resultado.insertId;
        } catch (erro) {
            console.error("Erro ao criar curso:", erro);
            throw erro;
        }
    }
}

module.exports = CursoModel;