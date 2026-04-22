const AtividadeModel = require('../models/AtividadeModel');
const HistoricoModel = require('../models/HistoricoModel'); 

class AtividadeController {

    
    static async criarAtividade(req, res) {
        try {
            
            const { id_usuario, nome, tipo, descricao, data_registro, id_checklist, id_sugestao } = req.body;

            
            if (!id_usuario || !nome || !tipo || !data_registro) {
                return res.status(400).json({ erro: "Campos obrigatórios (usuário, nome, tipo e data) estão faltando." });
            }

            const id_atividade = await AtividadeModel.criar({
                id_usuario, nome, tipo, descricao, data_registro, id_checklist, id_sugestao
            });
            
            res.status(201).json({ 
                mensagem: "Atividade criada com sucesso!", 
                id_atividade: id_atividade 
            });
        } catch (erro) {
            console.error(erro);
            res.status(500).json({ erro: "Erro interno ao criar a atividade." });
        }
    }

    
    static async listarDoDia(req, res) {
        try {
            
            const { id_usuario, data } = req.params;

            const atividades = await AtividadeModel.buscarPorUsuarioEData(id_usuario, data);

            
            res.status(200).json(atividades);
        } catch (erro) {
            console.error(erro);
            res.status(500).json({ erro: "Erro ao buscar as atividades do dia." });
        }
    }

    
    static async alternarStatus(req, res) {
        try {
            const { id_atividade } = req.params;
            const { concluida, id_usuario } = req.body; 

            
            const sucesso = await AtividadeModel.atualizarStatus(id_atividade, concluida);

            if (!sucesso) {
                return res.status(404).json({ erro: "Atividade não encontrada." });
            }

            
            if (concluida === true) {
                
                await HistoricoModel.registrarConclusao(id_atividade, id_usuario);
            } else {
                
                await HistoricoModel.removerRegistro(id_atividade, id_usuario);
            }

            res.status(200).json({ mensagem: "Status atualizado com sucesso!" });
        } catch (erro) {
            console.error(erro);
            res.status(500).json({ erro: "Erro ao atualizar o status da atividade." });
        }
    }

    
    static async deletar(req, res) {
        try {
            const { id_atividade } = req.params;
            const { id_usuario } = req.body; 

            const sucesso = await AtividadeModel.eliminar(id_atividade, id_usuario);

            if (sucesso) {
                res.status(200).json({ mensagem: "Atividade excluída com sucesso!" });
            } else {
                res.status(403).json({ erro: "Você não tem permissão para excluir esta atividade ou ela não existe." });
            }
        } catch (erro) {
            console.error(erro);
            res.status(500).json({ erro: "Erro ao excluir a atividade." });
        }
    }
}

module.exports = AtividadeController;