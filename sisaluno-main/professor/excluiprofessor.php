<?php
// permite acesso às variáveis dentro do arquivo conexao.php
require_once('conexao.php');

// verifica se o ID do professor foi fornecido na URL
if (isset($_GET['id_professor'])) {
    $id_professor = $_GET['id_professor'];

    // Código SQL para buscar o professor pelo ID
    $sql = "SELECT * FROM professor WHERE id_professor = :id_professor";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo do parâmetros
    $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);

    // Executa o SQL no banco de dados
    $stmt->execute();

    // Obtém os dados do professor como um array
    $professor = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o professor foi encontrado no banco de dados
    if ($professor) {

        // Exclui o registro do banco de dados
        $sql = "delete from professor where id_professor = :id_professor";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
        $stmt->execute();

        // Redireciona o usuário para a página de listagem
        header('Location: listaprofessores.php');
        exit;
    } else {
        echo "Professor não encontrado.";
    }
} else {
    echo "ID do professor não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Professor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Professor</h1>
        <form action="excluiprofessor.php" method="post">
            <input type="hidden" name="id_professor" value="<?php echo $professor['id_professor']; ?>">
            <label for="nome_professor">Nome:</label>
            <input type="text" name="nome_professor" id="nome_professor" value="<?php echo $professor['nome_professor']; ?>">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" value="<?php echo $professor['cpf']; ?>">
            <label for="siape">SIAPE:</label>
            <input type="text" name="siape" id="siape" value="<?php echo $professor['siape']; ?>">
            <label for="idade_professor">Idade:</label>
            <input type="number" name="idade_professor" id="idade_professor" value="<?php echo $professor['idade_professor']; ?>">
            <button type="submit" name="delete" class="button">Excluir</button>
            <button class="button"><a href="listaprofessores.php">Cancelar</a></button>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['delete'])) {
    $id_professor = $_POST['id_professor'];

    // Adicione uma mensagem de confirmação antes de excluir o registro.
    echo "<p>Tem certeza de que deseja excluir este registro?</p>";
    echo "<a href='excluiprofessor.php?id_professor=$id_professor&confirm=sim' class='button'>Sim</a>";
    echo "<a href='listaprofessores.php' class='button'>Não</a>";

    // Exclui o registro do banco de dados
    $sql = "delete from professor where id_professor = :id_professor";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona o usuário para a página de listagem
    header('Location: listaprofessores.php');
    exit;
}
?>