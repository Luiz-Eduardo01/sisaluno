<?php
// Valida os dados do formulário
if (!empty($_POST['nome_disciplina']) && !empty($_POST['ch']) && !empty($_POST['semestre']) && !empty($_POST['id_professor'])) {

    // Valida o ID da disciplina
    if (!empty($_POST['id_disciplina'])) {

        // Obtém a conexão com o banco de dados
        require_once('conexao.php');

        // Seleciona a disciplina do banco de dados
        $sql = "SELECT * FROM disciplina WHERE id_disciplina = :id_disciplina";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_disciplina', $_POST['id_disciplina'], PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se a disciplina foi encontrada
        if ($stmt->rowCount() == 1) {

            // Atualiza os dados da disciplina no banco de dados
            $sql = "UPDATE disciplina SET nome_disciplina = :nome_disciplina, ch = :ch, semestre = :semestre, id_professor = :id_professor WHERE id_disciplina = :id_disciplina";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome_disciplina', $_POST['nome_disciplina']);
            $stmt->bindParam(':ch', $_POST['ch']);
            $stmt->bindParam(':semestre', $_POST['semestre']);
            $stmt->bindParam(':id_professor', $_POST['id_professor']);
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
} else {
    echo "Preencha todos os campos do formulário.";
}
?>

<form method="POST" action="altdisciplina.php">
    <label for="">Nome da Disciplina:</label>
    <input type="text" name="nome_disciplina" value="">
    <label for="">Carga horária:</label>
    <input type="text" name="ch" value="">
    <label for="">Semestre:</label>
    <input type="text" name="semestre" value="">
    <label for="">Professor:</label>
    <input type="text" name="id_professor" value="">
    <input type="hidden" name="id_disciplina" value="">
    <input type="submit" name="update" value="Alterar">
    <input type="submit" name="cancel" value="Cancelar">
</form>

</body>
</html>