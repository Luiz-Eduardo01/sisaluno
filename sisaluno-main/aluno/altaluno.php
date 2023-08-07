<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// Valida os dados do formulário
if (!empty($_POST['nome_aluno']) && !empty($_POST['idade_aluno']) && !empty($_POST['datanascimento']) && !empty($_POST['endereco']) && !empty($_POST['estatus']) && !empty($_POST['matricula'])) {

    // Valida o ID do aluno
    if (!empty($_POST['id_aluno'])) {

        // Obtém a conexão com o banco de dados
        require_once('conexao.php');

        // Seleciona o aluno do banco de dados
        $sql = "SELECT * FROM aluno WHERE id_aluno = :id_aluno";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_aluno', $_POST['id_aluno'], PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se o aluno foi encontrado
        if ($stmt->rowCount() == 1) {

            // Atualiza os dados do aluno no banco de dados
            $sql = "UPDATE aluno SET nome_aluno = :nome_aluno, idade_aluno = :idade_aluno, datanascimento = :datanascimento, endereco = :endereco, estatus = :estatus, matricula = :matricula WHERE id_aluno = :id_aluno";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome_aluno', $_POST['nome_aluno']);
            $stmt->bindParam(':idade_aluno', $_POST['idade_aluno']);
            $stmt->bindParam(':datanascimento', $_POST['datanascimento']);
            $stmt->bindParam(':endereco', $_POST['endereco']);
            $stmt->bindParam(':estatus', $_POST['estatus']);
            $stmt->bindParam(':matricula', $_POST['matricula']);
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
} else {
    echo "Preencha todos os campos do formulário.";
}
?>

<form method="POST" action="crudaluno.php">
    <label for="">Nome do aluno:</label>
    <input type="text" name="nome_aluno" value="">
    <label for="">Idade:</label>
    <input type="text" name="idade_aluno" value="">
    <label for="">Data de Nascimento:</label>
    <input type="date" name="datanascimento" value="">
    <label for="">Endereço:</label>
    <input type="text" name="endereco" value="">
    <label for="">Status:</label>
    <input type="text" name="estatus" value="">
    <label for="">Matrícula:</label>
    <input type="text" name="matricula" value="">
    <input type="hidden" name="id_aluno" value="">
    <input type="submit" name="update" value="Alterar">
    <input type="submit" name="cancel" value="Cancelar">
</form>

</body>
</html>