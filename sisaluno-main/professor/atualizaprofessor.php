<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Professor</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
        <h1>Atualizar Professor</h1>
        <form action="atualizaprofessor.php" method="POST">
    <input type="hidden" name="id_professor" value="<?php echo $professor['id_professor']; ?>">
    <label>Nome:</label>
    <input type="text" name="nome_professor" value="<?php echo $professor['nome_professor']; ?>">
    <label>Idade:</label>
    <input type="number" name="idade_professor" value="<?php echo $professor['idade_professor']; ?>">
    <label>CPF:</label>
    <input type="text" name="cpf" value="<?php echo $professor['cpf']; ?>">
    <label>SIAPE:</label>
    <input type="number" name="siape" value="<?php echo $professor['siape']; ?>">
    <input type="submit" class="button" value="Atualizar Professor">
</form>

        <?php
        // permite acesso às variáveis dentro do arquivo conexao.php
        require_once('conexao.php');

// verifica se o ID do professor foi fornecido na URL
if (isset($_GET['id_professor'])) {
    $id_professor = $_GET['id_professor'];

    // Código SQL para buscar o professor pelo ID
    $sql = "SELECT * FROM professor WHERE id_professor = :id_professor";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
    $stmt->execute();
    $professor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($professor) {
        $form = gerarFormularioAtualizarProfessor($professor);
        echo $form;
    } else {
        echo "Professor não encontrado.";
    }
} else {
    echo "ID do professor não fornecido.";
}

if (!empty($_POST['id_professor']) && !empty($_POST['nome_professor']) && !empty($_POST['idade_professor']) && !empty($_POST['datanascimento']) && !empty($_POST['endereco']) && !empty($_POST['estatus']) && !empty($_POST['siape'])) {

if (isset($_POST['id_professor'], $_POST['nome_professor'], $_POST['cpf'], $_POST['siape'], $_POST['idade_professor'])) {
    $id_professor = $_POST['id_professor'];
    $nome_professor = $_POST['nome_professor'];
    $cpf = $_POST['cpf'];
    $siape = $_POST['siape'];
    $idade_professor = $_POST['idade_professor'];

    // Verifica se o professor foi encontrado
    if ($stmt->rowCount() == 1) {

    if ($idade <= 100) {
        $sql = "UPDATE professor SET nome_professor = :nome_professor, cpf = :cpf, siape = :siape, idade_professor = :idade_professor WHERE id_professor = :id_professor";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);
        $stmt->bindParam(':nome_professor', $nome_professor, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':siape', $siape, PDO::PARAM_INT);
        $stmt->bindParam(':idade_professor', $idade_professor, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<p class='success-msg'>Professor atualizado com sucesso!</p>";
        } else {
            echo "<p class='error-msg'>Erro ao atualizar professor.</p>";
        }
    } else {
        echo "<p class='error-msg'>A idade não pode ser maior que 100 anos.</p>";
    }
} else {
    echo "Dados do formulário não enviados.";
}
}
// Redireciona o usuário para a página de listagem
header('Location: listaprofessores.php');
exit;
}
?>
<button class="button"><a href="listaprofessores.php">Voltar</a></button>
</body>
</html>