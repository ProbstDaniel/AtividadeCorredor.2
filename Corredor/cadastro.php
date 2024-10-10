<?php
// Inclui a classe Database para que seja realizado depois um código com a conexão do servidor
require 'PHP/Connection.php';

// Cria a conexão com o banco de dados
$db = new Database('localhost', 'corredores', 'root1', '123456', 3307);
$db->connect(); // Conecta ao banco de dados

// Verifica se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $numero = $_POST['numero'];

    try {
        // Prepara a consulta dos dados obtidos por meio do formulário
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare("INSERT INTO participantes (nome, idade, numero) VALUES (:nome, :idade, :numero)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':numero', $numero);
        
        // Executa a inserção
        if ($stmt->execute()) {
            // Se a inserção for bem-sucedida, redireciona para a página index.php com uma mensagem de sucesso
            header("Location: index.php?status=success&message=Participante cadastrado com sucesso");
            exit();
        } else {
            // Se houver algum erro, redireciona para index.php com uma mensagem de erro
            header("Location: index.php?status=error&message=Erro ao cadastrar o participante");
            exit();
        }
    } catch (PDOException $e) {
        // Em caso de exceção, redireciona com uma mensagem de erro e exibe o erro
        header("Location: index.php?status=error&message=" . $e->getMessage());
        exit();
    }
} else {
    // Se o formulário não foi enviado, redireciona para a página inicial
    header("Location: index.php");
    exit();
}
