<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Alunos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Status</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno) { ?>
                    <tr>
                        <td><?php echo $aluno['id_aluno']; ?></td>
                        <td><?php echo $aluno['nome_aluno']; ?></td>
                        <td><?php echo $aluno['idade_aluno']; ?></td>
                        <td><?php echo $aluno['datanascimento']; ?></td>
                        <td><?php echo $aluno['endereco']; ?></td>
                        <td><?php echo $aluno['estatus']; ?></td>
                        <td><?php echo $aluno['matricula']; ?></td>
                        <td>
                            <a href="atualizaaluno.php?id=<?php echo $aluno['id_aluno']; ?>" class="acao">Atualizar</a>
                            <a href="excluialuno.php?id=<?php echo $aluno['id_aluno']; ?>" class="acao" onclick="return confirm('Tem certeza de que deseja excluir este registro?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="button"><a href="cadaluno.php">Cadastrar Aluno</a></button>
        <button class="button"><a href="index.php">Voltar</a></button>
    </div>
    <?php
$db = new PDO('mysql:host=localhost;dbname=escola', 'root', '');
$query = $db->query("select * from aluno");
if ($query->rowCount() > 0) {
    $alunos = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo 'Nenhum registro encontrado.';
}

?>
</body>
</html>