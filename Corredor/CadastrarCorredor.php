<?php
// Inclui o arquivo do database que  logo irá executar um código para realizar a sua conexão
require 'PHP/Connection.php';

// Código para realizar a conexão
$db = new Database('localhost', 'corredores', 'root1', '123456', 3307);
$db->connect(); // Conecta ao banco de dados

// Exibe mensagens de sucesso ou erro com base no resultado e na informação capturada
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';


$participantes = []; //define a variável aluno como vazia, que dá possibilidade para que ela seja preenchida com os dados inseridos
try {
    $pdo = $db->getConnection(); //faz com q o PDO(q faz a conexão e realiza consulta) se conecte com o database
    $stmt = $pdo->prepare("SELECT * FROM corredores.participantes");//o prepare "prepara" uma consulta pra ser realizada no sql
    $stmt->execute();//Stmt ele pega a consulta preparada e executa ela
    $participantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='error'>Erro ao buscar participantes: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro dos corredores</title>
    <link rel="stylesheet" href="CSS/StyleCadastrar.css">
</head>
<body>
    <div class="ContainerGrande">
        <h1>Cadastro dos Participantes</h1>
        <!-- Formulário de cadastro que envia os dados para o cadastro.php para que sejam inseridos os dados no db-->
        <form action="cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome aqui" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" placeholder="Qual sua idade?" required>

            <label for="numero">Número de Corrida:</label>
            <input type="number" id="numero" name="numero" placeholder="Insira seu número de corrida" required>

            <input class="Cadastrar" type="submit" value="Cadastrar">
        </form>
                <!-- Exibe mensagem de sucesso ou erro com base na variável status, criada anteriormente-->
                <?php if ($status == 'success'): ?>
        <p class="Successo">Participante cadastrado com sucesso!</p>
    <?php elseif ($status == 'error'): ?>
        <p class="Erro">Erro ao cadastrar participante: <?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    </div>
</body>
</html>
