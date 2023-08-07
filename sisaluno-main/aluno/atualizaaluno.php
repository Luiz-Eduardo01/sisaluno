<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Aluno</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Aluno</h1>
        <form action="atualizaaluno.php" method="POST">
                    <input type="hidden" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
                    <label>Nome:</label>
                    <input type="text" name="nome_aluno" value="<?php echo $aluno['nome_aluno']; ?>">
                    <label>Idade:</label>
                    <input type="number" name="idade_aluno" value="<?php echo $aluno['idade_aluno']; ?>">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="datanascimento" value="<?php echo $aluno['datanascimento']; ?>">
                    <label>Endereço:</label>
                    <input type="text" name="endereco" value="<?php echo $aluno['endereco']; ?>">
                    <label>Status:</label>
                    <input type="radio" name="estatus" value="1" <?php if ($aluno['estatus'] == 1) echo 'checked'; ?>> Ativo
                    <input type="radio" name="estatus" value="0" <?php if ($aluno['estatus'] == 0) echo 'checked'; ?>> Inativo
                    <label for="matricula">Matrícula:</label>
                    <input type="text" name="matricula" id="matricula" value="<?php echo $aluno['matricula']; ?>">
                    <input type="hidden" name="id_aluno" value="<?php echo $aluno['id_aluno']; ?>">
                    <button type="submit" class="button">Atualizar Aluno</button>
                </form>
                <?php

// permite acesso às variáveis dentro do arquivo conexao.php
require_once('conexao.php');

// verifica se o ID do aluno foi fornecido na URL
if (isset($_GET['id_aluno'])) {
    $id_aluno = $_GET['id_aluno'];

    // Código SQL para buscar o aluno pelo ID
    $sql = "SELECT * FROM aluno WHERE id_aluno = :id_aluno";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($aluno) {
        $form = gerarFormularioAtualizarAluno($aluno);
        echo $form;
    } else {
        echo "Aluno não encontrado.";
    }
} else {
    echo "ID do aluno não fornecido.";
}
   
        if (!empty($_POST['id_aluno']) && !empty($_POST['nome_aluno']) && !empty($_POST['idade_aluno']) && !empty($_POST['datanascimento']) && !empty($_POST['endereco']) && !empty($_POST['estatus']) && !empty($_POST['matricula'])) {

        if (isset($_POST['id_aluno'], $_POST['nome_aluno'], $_POST['idade_aluno'], $_POST['datanascimento'], $_POST['endereco'], $_POST['estatus'], $_POST['matricula'])) {
            $id_aluno = $_POST['id_aluno'];
            $nome_aluno = $_POST['nome_aluno'];
            $idade_aluno = $_POST['idade_aluno'];
            $datanascimento = $_POST['datanascimento'];
            $endereco = $_POST['endereco'];
            $estatus = $_POST['estatus'];
            $matricula = $_POST['matricula'];

            // Verifica se o aluno foi encontrado
            if ($stmt->rowCount() == 1) {

            if ($idade_aluno <= 100) {
                $sql = "UPDATE Aluno SET nome_aluno = :nome_aluno, idade_aluno = :idade_aluno, datanascimento = :datanascimento, endereco = :endereco, estatus = :estatus, matricula = :matricula WHERE id_aluno = :id_aluno";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':nome_aluno', $nome_aluno, PDO::PARAM_STR);
                $stmt->bindParam(':idade_aluno', $idade_aluno, PDO::PARAM_INT);
                $stmt->bindParam(':datanascimento', $datanascimento, PDO::PARAM_STR);
                $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $stmt->bindParam(':estatus', $estatus, PDO::PARAM_INT);
                $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);
                $stmt->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT); 
                
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
        // Redireciona o usuário para a página de listagem
        header('Location: listadisciplinas.php');
        exit;
    }
}
?>
<button class="button"><a href="listaalunos.php">Voltar</a></button>
</div>
</body>
</html>