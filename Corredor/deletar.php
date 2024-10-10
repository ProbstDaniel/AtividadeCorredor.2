<?php
// Inclui a classe Database para que haja um código de conexão
require 'PHP/db.php';

    // Código responsável pela conexão com o banco de dados
    $db = new Database('localhost', 'corredores', 'root1', '123456', 3307);
    $db->connect(); // Conecta ao banco de dados

    // Verifica se o ID do aluno foi achado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        // Prepara a consulta responsável por excluir a partir do id achado
        $pdo = $db->getConnection();
        $stmt = $pdo->prepare("DELETE FROM corredores.participantes WHERE id = :id");
        $stmt->bindParam(':id', $id);

        // 
        if ($stmt->execute()) {
            // Se o id junto com o email e o resto for excluído corretamente, manda pra página index.php com uma mensagem de sucesso
            header("Location: index.php?status=deleted");
            exit();
        } else {
            // Se não forem exluídas corretamente as informações, redireciona para index.php com uma mensagem de erro
            header("Location: index.php?status=delete_error");
            exit();
        }
    } catch (PDOException $e) {
        // Manda pro index.php com uma mensagem de erro e exibe o motivo do erro
        header("Location: index.php?status=delete_error&message=" . $e->getMessage());
        exit();
    }
} else {
    // Redireciona para index.php se o ID não for achado
    header("Location: index.php?status=delete_error&message=ID não fornecido");
    exit();
}

