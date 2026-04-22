const ChecklistModel = require('../models/ChecklistModel');

class ChecklistController {

    
    static async iniciarDia(req, res) {
        try {
            const { id_usuario, data_criacao } = req.body;

            if (!id_usuario || !data_criacao) {
                return res.status(400).json({ erro: "ID do usuário e data são obrigatórios." });
            }

            const id_checklist = await ChecklistModel.criar(id_usuario, data_criacao);
            
            res.status(201).json({ 
                mensagem: "Checklist do dia preparado!", 
                id_checklist: id_checklist 
            });
        } catch (erro) {
            console.error("Erro ao iniciar dia:", erro);
            res.status(500).json({ erro: "Erro ao gerar checklist diário." });
        }
    }

    
    static async buscarHistorico(req, res) {
        try {
            const { id_usuario } = req.params;

            const historico = await ChecklistModel.listarHistorico(id_usuario);
            
            if (historico.length === 0) {
                return res.status(200).json({ mensagem: "Nenhum histórico encontrado ainda." });
            }

            res.status(200).json(historico);
        } catch (erro) {
            console.error("Erro ao buscar histórico:", erro);
            res.status(500).json({ erro: "Erro ao carregar a lista do histórico." });
        }
    }

    
    static async excluirRegistro(req, res) {
        try {
            const { id_checklist } = req.params;
            const { id_usuario } = req.body;

            const deletado = await ChecklistModel.eliminar(id_checklist, id_usuario);

            if (deletado) {
                res.status(200).json({ mensagem: "Registro de data removido com sucesso." });
            } else {
                res.status(404).json({ erro: "Registro não encontrado ou você não tem permissão." });
            }
        } catch (erro) {
            console.error("Erro ao excluir checklist:", erro);
            res.status(500).json({ erro: "Erro interno ao tentar excluir o registro." });
        }
    }
}

module.exports = ChecklistController;