const RecompensaModel = require('../models/RecompensaModel');
const HistoricoModel = require('../models/HistoricoModel');

class RecompensaController {

    
    static async listarGaleria(req, res) {
        try {
            const todas = await RecompensaModel.listarTodas();
            res.status(200).json(todas);
        } catch (erro) {
            console.error("Erro ao listar galeria:", erro);
            res.status(500).json({ erro: "Erro ao carregar galeria de recompensas." });
        }
    }

    
    static async listarConquistasUsuario(req, res) {
        try {
            const { id_usuario } = req.params;
            const conquistas = await RecompensaModel.buscarPorUsuario(id_usuario);
            res.status(200).json(conquistas);
        } catch (erro) {
            console.error("Erro ao buscar conquistas:", erro);
            res.status(500).json({ erro: "Erro ao carregar suas conquistas." });
        }
    }

    
    static async verificarNovasConquistas(req, res) {
        try {
            const { id_usuario } = req.body;

            
            const totalConcluidas = await HistoricoModel.contarConcluidas(id_usuario);

            let medalhaGanha = null;

            
            if (totalConcluidas >= 1 && totalConcluidas < 10) {
                const jaTem = await RecompensaModel.jaPossui(id_usuario, 1);
                if (!jaTem) {
                    await RecompensaModel.registrarConquista(id_usuario, 1);
                    medalhaGanha = "Bronze: Primeiro Passo!";
                }
            } else if (totalConcluidas >= 50) {
                const jaTem = await RecompensaModel.jaPossui(id_usuario, 2);
                if (!jaTem) {
                    await RecompensaModel.registrarConquista(id_usuario, 2);
                    medalhaGanha = "Ouro: Mestre da Rotina!";
                }
            }

            if (medalhaGanha) {
                res.status(200).json({ novoDesbloqueio: true, mensagem: medalhaGanha });
            } else {
                res.status(200).json({ novoDesbloqueio: false });
            }

        } catch (erro) {
            console.error("Erro ao verificar conquistas:", erro);
            res.status(500).json({ erro: "Erro ao processar gamificação." });
        }
    }
}

module.exports = RecompensaController;