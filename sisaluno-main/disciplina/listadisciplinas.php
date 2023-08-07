<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Disciplinas</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Disciplinas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Carga Horária</th>
                    <th>Semestre</th>
                    <th>Professor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($disciplinas as $disciplina) { ?>
                    <tr>
                        <td><?php echo $disciplina['id_disciplina']; ?></td>
                        <td><?php echo $disciplina['nome_disciplina']; ?></td>
                        <td><?php echo $disciplina['ch']; ?></td>
                        <td><?php echo $disciplina['semestre']; ?></td>
                        <td><?php echo $disciplina['id_professor']; ?></td>
                        <td>
                            <a href="atualizadisciplina.php?id=<?php echo $disciplina['id_disciplina']; ?>" class="acao">Atualizar</a>
                            <a href="excluidisciplina.php?id=<?php echo $disciplina['id_disciplina']; ?>" class="acao" onclick="return confirm('Tem certeza de que deseja excluir este registro?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="button"><a href="cadastrodisciplina.php">Cadastrar Disciplina</a></button>
        <button class="button"><a href="index.php">Voltar</a></button>
    </div>
    <?php
$db = new PDO('mysql:host=localhost;dbname=escola', 'root', '');
$query = $db->query("select * from disciplina");
if ($query->rowCount() > 0) {
    $disciplinas = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo 'Nenhum registro encontrado.';
}

?>
</body>
</html>