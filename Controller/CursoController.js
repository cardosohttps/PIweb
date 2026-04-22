const CursoModel = require('../models/CursoModel');

class CursoController {

    
    static async listarCursos(req, res) {
        try {
            const cursos = await CursoModel.listarTodos();
            res.status(200).json(cursos);
        } catch (erro) {
            console.error("Erro ao listar cursos:", erro);
            res.status(500).json({ erro: "Erro ao buscar a lista de cursos." });
        }
    }

    
    static async obterSugestoes(req, res) {
        try {
            const { id_curso } = req.params;

            if (!id_curso) {
                return res.status(400).json({ erro: "O ID do curso é obrigatório." });
            }

            const sugestoes = await CursoModel.buscarSugestoesPorCurso(id_curso);
            
            if (sugestoes.length === 0) {
                return res.status(404).json({ mensagem: "Nenhuma sugestão encontrada para este curso." });
            }

            res.status(200).json(sugestoes);
        } catch (erro) {
            console.error("Erro ao buscar sugestões:", erro);
            res.status(500).json({ erro: "Erro interno ao buscar sugestões do curso." });
        }
    }

    
    static async detalhesCurso(req, res) {
        try {
            const { id } = req.params;
            const curso = await CursoModel.buscarPorId(id);

            if (!curso) {
                return res.status(404).json({ erro: "Curso não encontrado." });
            }

            res.status(200).json(curso);
        } catch (erro) {
            res.status(500).json({ erro: "Erro ao buscar detalhes do curso." });
        }
    }
}

module.exports = CursoController;