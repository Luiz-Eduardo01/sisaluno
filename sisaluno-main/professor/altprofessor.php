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
if (!empty($_POST['nome_professor']) && !empty($_POST['cpf']) && !empty($_POST['siape']) && !empty($_POST['idade'])) {

    // Valida o ID do professor
    if (!empty($_POST['id_professor'])) {

        // Obtém a conexão com o banco de dados
        require_once('conexao.php');

        // Seleciona o professor do banco de dados
        $sql = "SELECT * FROM professor WHERE id_professor = :id_professor";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_professor', $_POST['id_professor'], PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se o professor foi encontrado
        if ($stmt->rowCount() == 1) {

            // Atualiza os dados do professor no banco de dados
            $sql = "UPDATE professor SET nome_professor = :nome_professor, cpf = :cpf, siape = :siape, idade = :idade WHERE id_professor = :id_professor";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome_professor', $_POST['nome_professor']);
            $stmt->bindParam(':cpf', $_POST['cpf']);
            $stmt->bindParam(':siape', $_POST['siape']);
            $stmt->bindParam(':idade', $_POST['idade']);
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
} else {
    echo "Preencha todos os campos do formulário.";
}
?>

<form method="POST" action="crudaprofe.php">
    <label for="">Nome do professor:</label>
    <input type="text" name="nome_professor" value="">
    <label for="">CPF:</label>
    <input type="text" name="cpf" value="">
    <label for="">SIAPE:</label>
    <input type="text" name="siape" value="">
    <label for="">Idade:</label>
    <input type="text" name="idade" value="">
    <input type="hidden" name="id_professor" value="">
    <input type="submit" name="update" value="Alterar">
    <input type="submit" name="cancel" value="Cancelar">
</form>

</body>
</html>