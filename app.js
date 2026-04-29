const express = require('express');
const app = express();
const db = require('./config/database'); 


const UsuarioController = require('./controllers/UsuarioController');
const AtividadeController = require('./controllers/AtividadeController');

app.use(express.json()); 




app.get('/', (req, res) => res.send(' Servidor do Routine Hacker operante!'));


app.post('/usuarios', UsuarioController.cadastrar);


app.get('/atividades/:id_usuario/:data', AtividadeController.listarDoDia);


const PORT = 3000;
app.listen(PORT, () => {
    console.log(`🚀 Servidor rodando em http://localhost:${PORT}`);
});