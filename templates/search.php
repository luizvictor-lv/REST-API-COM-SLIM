<?php
// Arquivo PHP para lidar com a lógica de busca e renderização
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['nome'])) {
        // Lógica para buscar usuários por nome usando Slim ou outro método
        // Exemplo básico:
        $nome = $_GET['nome'];
        $users = []; // Implemente a lógica para buscar usuários por nome
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Usuário</title>
    <!-- Incluir links para CSS, JS, etc. -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <h1>Pesquisar Por Nome</h1>
    <form method="GET" action="">
        <input type="text" name="nome" placeholder="Nome" required>
        <button type="submit">Pesquisar</button>
    </form>

    <!-- Exibir resultados da busca -->
    <?php if (!empty($users)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nome']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['telefone']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (isset($_GET['nome']) && empty($users)): ?>
        <p>Nenhum resultado encontrado para "<?php echo htmlspecialchars($_GET['nome'], ENT_QUOTES, 'UTF-8'); ?>"</p>
    <?php endif; ?>

    <a href="cadastra.html" class="btn-back">Cadastrar Novo Usuário</a>
    <a href="atualizar.html" class="btn-back">Editar Usuário</a>
    <a href="delete.html" class="btn-back">Apagar Usuário</a>

    <!-- Incluir scripts JS, etc. -->
    <script src="assets/js/script.js"></script>
</body>
</html>
