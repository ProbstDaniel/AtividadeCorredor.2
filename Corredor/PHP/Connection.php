<?php
class Database {

    private $pdo;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;

    public function __construct($host, $db, $user, $pass, $port = 3307) {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port; //nesse caso a porta padrão é 3307

    }

    // Método para conectar ao banco de dados
    public function connect() {
        try {
            // Cria uma nova instância de PDO (interface que é responsável pelo acesso aos dados do DB) para MySQL
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            
            // Define o modo de erro do PDO para exceções e mostra o motivo do erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //caso a conexão dê certo, apenas não irá aparecer nada
        } catch (PDOException $e) {
            // Exibe a mensagem de erro caso a conexão falhe
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "<br>";
        }
        
     }
     public function getConnection(){
        return $this->pdo;
        //permite que outros sites se conectem ao banco de dados 
    }
}
