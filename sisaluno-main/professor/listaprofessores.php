<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Professores</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>SIAPE</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professores as $professor) { ?>
                    <tr>
                        <td><?php echo $professor['id_professor']; ?></td>
                        <td><?php echo $professor['nome_professor']; ?></td>
                        <td><?php echo $professor['cpf']; ?></td>
                        <td><?php echo $professor['siape']; ?></td>
                        <td><?php echo $professor['idade_professor']; ?></td>
                        <td>
                            <a href="atualizaprofessor.php?id=<?php echo $professor['id_professor']; ?>" class="acao">Atualizar</a>
                            <a href="excluiprofessor.php?id=<?php echo $professor['id_professor']; ?>" class="acao" onclick="return confirm('Tem certeza de que deseja excluir este registro?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button class="button"><a href="cadprofessor.php">Cadastrar Professor</a></button>
        <button class="button"><a href="index.php">Voltar</a></button>
    </div>
    <?php
$db = new PDO('mysql:host=localhost;dbname=escola', 'root', '');
$id_professor = $_GET['id_professor'];
$query = $db->query("select * from professor where id_professor = '$id_professor'");
if ($query->rowCount() > 0) {
    $professor = $query->fetch(PDO::FETCH_ASSOC);
    echo '<form action="atualizaprofessor.php" method="post">
        <input type="hidden" name="id_professor" value="' . $professor['id_professor'] . '">
        <input type="text" name="nome_professor" value="' . $professor['nome_professor'] . '">
        <input type="text" name="idade_professor" value="' . $professor['idade_professor'] . '">
        <input type="submit" value="Modificar">
    </form>';
} else {
    echo 'Registro não encontrado.';
}

?>
</body>
</html>