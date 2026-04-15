const mysql = require('mysql2/promise');


const pool = mysql.createPool({
    host: 'localhost',      
    password: '',           //senha do MySQL (XAMPP vazio)
    database: 'routine_hacker',
    waitForConnections: true,
    connectionLimit: 10,    
    queueLimit: 0
});


pool.getConnection()
    .then(connection => {
        console.log('✅ Conexão com o banco de dados routine_hacker estabelecida com sucesso!');
        connection.release(); 
    })
    .catch(err => {
        console.error('❌ Erro ao conectar com o banco de dados:', err.message);
    });


module.exports = pool;