<?php
// permite acesso às variáveis dentro do arquivo conexao.php
require_once('conexao.php');

// verifica se o ID da disciplina foi fornecido na URL
if (isset($_GET['id_disciplina'])) {
    $id_disciplina = $_GET['id_disciplina'];

    // Código SQL para buscar a disciplina pelo ID
    $sql = "SELECT * FROM disciplina WHERE id_disciplina = :id_disciplina";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetros
    $stmt->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);

    // Executa o SQL no banco de dados
    $stmt->execute();

    // Obtém os dados da disciplina como um array
    $disciplina = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a disciplina foi encontrada no banco de dados
    if ($disciplina) {

        // Exclui o registro do banco de dados
        $sql = "delete from disciplina where id_disciplina = :id_disciplina";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);
        $stmt->execute();

        // Redireciona o usuário para a página de listagem
        header('Location: listadisciplinas.php');
        exit;
    } else {
        echo "Disciplina não encontrada.";
    }
} else {
    echo "ID da disciplina não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Disciplina</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Disciplina</h1>
        <form action="excluirdisciplina.php" method="post">
            <input type="hidden" name="id_disciplina" value="<?php echo $disciplina['id_disciplina']; ?>">
            <label for="nome_disciplina">Nome:</label>
            <input type="text" name="nome_disciplina" id="nome_disciplina" value="<?php echo $disciplina['nome_disciplina']; ?>">
            <label for="ch">Carga horária:</label>
            <input type="text" name="ch" id="ch" value="<?php echo $disciplina['ch']; ?>">
            <label for="semestre">Semestre:</label>
            <input type="text" name="semestre" id="semestre" value="<?php echo $disciplina['semestre']; ?>">
            <label for="id_professor">Professor:</label>
            <input type="text" name="id_professor" id="id_professor" value="<?php echo $disciplina['id_professor']; ?>">
            <button type="submit" name="delete" class="button">Excluir</button>
            <button class="button"><a href="listadisciplinas.php">Cancelar</a></button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['delete'])) {
    $id_disciplina = $_POST['id_disciplina'];
    $confirm = $_POST['confirm'];

    // Adicione uma mensagem de confirmação antes de excluir o registro.
    echo "<p>Tem certeza de que deseja excluir este registro?</p>";
    echo "<a href='excluirdisciplina.php?id_disciplina=$id_disciplina&confirm=sim' class='button'>Sim</a>";
    echo "<a href='listadisciplinas.php' class='button'>Não</a>";

    if ($confirm == "sim") {
        // Exclui o registro do banco de dados
        $sql = "delete from disciplina where id_disciplina = :id_disciplina";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);
        $stmt->execute();

        // Redireciona o usuário para a página de listagem
        header('Location: listadisciplinas.php');
        exit;
    }
}
?>