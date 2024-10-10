<?php
// Inclui a classe Database
require 'PHP/Connection.php';

// Cria a conexão com o banco de dados
$db = new Database('localhost', 'corredores', 'root1', '123456', 3307);
$db->connect(); // Conecta ao banco de dados

// Exibe mensagens de sucesso ou erro baseadas nos parâmetros da URL
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';

// Busca os alunos cadastrados no banco de dados
$participante = [];
try {
    $pdo = $db->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM corredores.participantes");
    $stmt->execute();
    $participantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p class='error'>Erro ao buscar participante: " . $e->getMessage() . "</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Participantes Cadastrados</title>
    <link rel="stylesheet" href="CSS/Style1.css">
</head>
<body>
    <!-- Tabela para listar os alunos cadastrados -->
    <div class="ContainerGrande">
        <h2>Corredores Cadastrados</h2>
        <?php if (count($participantes) > 0): ?>
        <!--Se o número de alunos for maior q zero irá "puxar" os dados do DB-->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Número</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participantes as $participante): ?>
                        <tr>
                            <td><?= htmlspecialchars($participante['id']) ?></td>
                            <td><?= htmlspecialchars($participante['nome']) ?></td>
                            <td><?= htmlspecialchars($participante['idade']) ?></td>
                            <td><?= htmlspecialchars($participante['numero']) ?></td>
                            <td>
                                <a href="deletar.php?id=<?= $aluno['id'] ?>" class="deletar" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
        <!--Se n houver nenhum aluno cadastrado vai aparecer essa mensagen-->
            <p>Nenhum aluno cadastrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
