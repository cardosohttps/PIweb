
const db = require('../config/database'); 

const bcrypt = require('bcrypt');

class UsuarioModel {
    
    
    static async criar(nome, email, senhaLimpa, id_curso = null) {
        try {
            
            const senhaCriptografada = await bcrypt.hash(senhaLimpa, 10);
            
            const query = `
                INSERT INTO usuarios (nome, email, senha, id_curso) 
                VALUES (?, ?, ?, ?)
            `;
            
            
            const [resultado] = await db.execute(query, [nome, email, senhaCriptografada, id_curso]);
            
            
            return resultado.insertId; 
        } catch (erro) {
            console.error("Erro ao criar usuário:", erro);
            throw erro;
        }
    }

    
    static async buscarPorEmail(email) {
        try {
            const query = `SELECT * FROM usuarios WHERE email = ?`;
            const [linhas] = await db.execute(query, [email]);
            
            
            return linhas[0];
        } catch (erro) {
            console.error("Erro ao buscar usuário por email:", erro);
            throw erro;
        }
    }

    
    static async buscarPorId(id_usuario) {
        try {
            
            const query = `
                SELECT u.id_usuario, u.nome, u.email, u.foto_perfil, u.descricao, c.nome as nome_curso 
                FROM usuarios u
                LEFT JOIN cursos c ON u.id_curso = c.id_curso
                WHERE u.id_usuario = ?
            `;
            const [linhas] = await db.execute(query, [id_usuario]);
            
            return linhas[0];
        } catch (erro) {
            console.error("Erro ao buscar usuário por ID:", erro);
            throw erro;
        }
    }

    
    static async atualizarPerfil(id_usuario, descricao, foto_perfil) {
        try {
            const query = `
                UPDATE usuarios 
                SET descricao = ?, foto_perfil = ? 
                WHERE id_usuario = ?
            `;
            const [resultado] = await db.execute(query, [descricao, foto_perfil, id_usuario]);
            
           
            return resultado.affectedRows > 0;
        } catch (erro) {
            console.error("Erro ao atualizar perfil:", erro);
            throw erro;
        }
    }
}

module.exports = UsuarioModel;