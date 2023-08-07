<?php
// permite acesso às variáveis dentro do arquivo conexao.php
require_once('conexao.php');

// verifica se o ID do aluno foi fornecido na URL
if (isset($_GET['id_aluno'])) {
    $id_aluno = $_GET['id_aluno'];

    // Código SQL para buscar o aluno pelo ID
    $sql = "SELECT * FROM aluno WHERE id_aluno = :id_aluno";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetros
    $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);

    // Executa o SQL no banco de dados
    $stmt->execute();

    // Obtém os dados do aluno como um array
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o aluno foi encontrado no banco de dados
    if ($aluno) {

        // Exclui o registro do banco de dados
        $sql = "delete from aluno where id_aluno = :id_aluno";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
        $stmt->execute();

        // Redireciona o usuário para a página de listagem
        header('Location: listaalunos.php');
        exit;
    } else {
        echo "Aluno não encontrado.";
    }
} else {
    echo "ID do aluno não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Aluno</h1>
        <form action="excluialuno.php" method="post">
            <input type="hidden" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
            <label for="nome_aluno">Nome:</label>
            <input type="text" name="nome_aluno" id="nome_aluno" value="<?php echo $aluno['nome_aluno']; ?>">
            <label for="idade_aluno">Idade:</label>
            <input type="number" name="idade_aluno" id="idade_aluno" value="<?php echo $aluno['idade_aluno']; ?>">
            <label for="datanascimento">Data de Nascimento:</label>
            <input type="date" name="datanascimento" id="datanascimento" value="<?php echo $aluno['datanascimento']; ?>">
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo $aluno['endereco']; ?>">
            <label for="estatus">Status:</label>
            <input type="radio" name="estatus" value="1" <?php if ($aluno['estatus'] == 1) echo 'checked'; ?>> Ativo
            <input type="radio" name="estatus" value="0" <?php if ($aluno['estatus'] == 0) echo 'checked'; ?>> Inativo
            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" id="matricula" value="<?php echo $aluno['matricula']; ?>">
            <input type="hidden" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
            <button type="submit" name="delete" class="button">Excluir</button>
            <button class="button"><a href="listaalunos.php">Cancelar</a></button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['delete'])) {
    $id_aluno = $_POST['id_aluno'];

     // Adicione uma mensagem de confirmação antes de excluir o registro.
     echo "<p>Tem certeza de que deseja excluir este registro?</p>";
     echo "<a href='excluialuno.php?id=$id_aluno&confirm=sim' class='button'>Sim</a>";
     echo "<a href='listaalunos.php' class='button'>Não</a>";

    // Exclui o registro do banco de dados
    $sql = "delete from aluno where id_aluno = :id_aluno";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona o usuário para a página de listagem
    header('Location: listaalunos.php');
    exit;
}
?>