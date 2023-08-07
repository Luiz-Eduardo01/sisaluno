<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Disciplina</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Aluno</h1>
        <form method="POST" action="atualizadisciplina.php">
            <input type="hidden" name="id_disciplina" value="<?php echo $_POST['id_disciplina']; ?>">
            <label>Nome da Disciplina:</label>
            <input type="text" name="nome_disciplina" value="<?php echo $_POST['nome_disciplina']; ?>">
            <label>Carga horária:</label>
            <input type="text" name="ch" value="<?php echo $_POST['ch']; ?>">
            <label>Semestre:</label>
            <input type="text" name="semestre" value="<?php echo $_POST['semestre']; ?>">
            <label>Professor:</label>
            <input type="number" name="id_professor" value="<?php echo $_POST['id_professor']; ?>">
            <button type="submit" class="button">Atualizar Disciplina</button>
        </form>

<?php
// Obtém a conexão com o banco de dados
require_once('conexao.php');

// verifica se o ID da disciplina foi fornecido na URL
if (isset($_GET['id_disciplina'])) {
    $id_disciplina = $_POST['id_disciplina'];

    // Seleciona a disciplina do banco de dados
    $sql = "SELECT * FROM disciplina WHERE id_disciplina = :id_disciplina";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_disciplina', $_POST['id_disciplina'], PDO::PARAM_INT);
    $stmt->execute();
    

    if ($disciplina) {$form = gerarFormularioAtualizarDisciplina($disciplina);
        echo $form;
    } else {
        echo "Disciplina não encontrada.";
    }
} else {
    echo "Preencha todos os campos do formulário.";
}

// Valida os dados do formulário
if (!empty($_POST['id_disciplina']) && !empty($_POST['nome_disciplina']) && !empty($_POST['ch']) && !empty($_POST['semestre']) && !empty($_POST['id_professor'])) {

    if (isset($_POST['id_disciplina'], $_POST['nome_disciplina'], $_POST['ch'], $_POST['semestre'], $_POST['id_professor'])) {
        $id_disciplina = $_POST['id_disciplina'];
        $nome_disciplina = $_POST['nome_disciplina'];
        $ch = $_POST['ch'];
        $semestre = $_POST['semestre'];
        $id_professor = $_POST['id_professor'];

    // Verifica se a disciplina foi encontrada
    if ($stmt->rowCount() == 1) {

        // Atualiza os dados da disciplina no banco de dados
        $sql = "UPDATE disciplina SET nome_disciplina = :nome_disciplina, ch = :ch, semestre = :semestre, id_professor = :id_professor WHERE id_disciplina = :id_disciplina";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome_disciplina', $_POST['nome_disciplina'], PDO::PARAM_STR);
        $stmt->bindParam(':ch', $_POST['ch'], PDO::PARAM_STR);
        $stmt->bindParam(':semestre', $_POST['semestre'], PDO::PARAM_STR);
        $stmt->bindParam(':id_professor', $_POST['id_professor'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->execute()) {
            echo "<p class='success-msg'>Disciplina atualizado com sucesso!</p>";
        } else {
            echo "<p class='error-msg'>Erro ao atualizar disciplina.</p>";
        }
    } else {
        echo "<p class='error-msg'>A idade do professor não pode ser maior que 100 anos.</p>";
    }
} else {
    echo "Dados do formulário não enviados.";
}
        // Redireciona o usuário para a página de listagem
        header('Location: listadisciplinas.php');
        exit;
    }
?>
<button class="button"><a href="listadisciplinas.php">Voltar</a></button>
</div>
</body>
</html>