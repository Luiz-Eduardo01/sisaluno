<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>

<?php
function gerarFormularioCadastroDisciplina() {
    $conexao = require_once('conexao.php');
    ?>
    <form method="POST" action="caddisciplina.php">
        <label for="nome_disciplina">Nome da disciplina:</label>
        <input type="text" name="nome_disciplina" required>
        <label for="carga_horaria">Carga horária:</label>
        <input type="text" name="carga_horaria" pattern="[0-9]+" title="Digite apenas números" required>
        <label for="semestre">Semestre:</label>
        <input type="text" name="semestre" required>
        <label for="id_professor">Professor:</label>
        <select name="id_professor" required>
            <option value="">Selecione um professor</option>
            <?php
            $sql = "SELECT * FROM professor ORDER BY nome_professor";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='$row[id_professor]'>$row[nome_professor]</option>";
            }
            ?>
        </select>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>

    <button class="button"><a href="index.php">Voltar</a></button>
    
    <?php
}

  ## Permite acesso às variáveis dentro do arquivo `conexao.php`
require_once('conexao.php');

## Cadastrar disciplina
if(isset($_POST['cadastrar'])){
    require_once('conexao.php');

    // Dados recebidos pelo método POST
    $nome_disciplina = $_POST['nome_disciplina'];
    $carga_horaria = $_POST['carga_horaria'];
    $semestre = $_POST['semestre'];
    $id_professor = $_POST['id_professor'];

    // Verifica se a idade é maior que 100 anos
    if (verificarIdade($idade_professor)) {
        // Código SQL
        $sql = "INSERT INTO disciplina(nome_disciplina, carga_horaria, semestre, id_professor) 
                VALUES(:nome_disciplina, :carga_horaria, :semestre, :id_professor)";

        // Junta o código SQL à conexão do banco
        $stmt = $conexao->prepare($sql);

        // Diz o parâmetro e o tipo dos parâmetros
        $stmt->bindParam(':nome_disciplina', $nome_disciplina, PDO::PARAM_STR);
        $stmt->bindParam(':carga_horaria', $carga_horaria, PDO::PARAM_STR);
        $stmt->bindParam(':semestre', $semestre, PDO::PARAM_STR);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);

        // Executa o SQL no banco de dados
        if ($stmt->execute()) {
            echo "<strong>OK!</strong> A disciplina $nome_disciplina foi cadastrada com sucesso!";
            echo " <button class='button'><a href='index.html'>voltar</a></button>";
        } else {
            echo "Erro ao cadastrar disciplina.";
        }
    } else {
        echo "A idade não pode ser maior que 100 anos.";
    }
}
?>

<script>
function validarDadosFormulario() {
    // Validar nome
    var nome_disciplina = document.getElementById("nome_disciplina").value;
    if (nome_disciplina == "") {
        alert("Por favor, digite o nome da disciplina.");
        return false;

        // Validar carga horária
var carga_horaria = document.getElementById("carga_horaria").value;
if (carga_horaria == "") {
    alert("Por favor, digite a carga horária da disciplina.");
    return false;
}

// Validar semestre
var semestre = document.getElementById("semestre").value;
if (semestre == "") {
    alert("Por favor, digite o semestre da disciplina.");
    return false;
}

// Validar professor
var id_professor = document.getElementById("id_professor").value;
if (id_professor == "") {
    alert("Por favor, selecione um professor.");
    return false;
}

// Todas as informações estão preenchidas corretamente
return true;
}
// Cadastrar disciplina
if(isset($_POST['cadastrar'])) {
    require_once('conexao.php');

    // Dados recebidos pelo método POST
    $nome_disciplina = $_POST['nome_disciplina'];
    $carga_horaria = $_POST['carga_horaria'];
    $semestre = $_POST['semestre'];
    $id_professor = $_POST['id_professor'];

    // Verifica se a idade do professor é maior que 100 anos
    if (verificarIdade($idade_professor)) {
        // Código SQL
        $sql = "INSERT INTO disciplina(nome_disciplina, carga_horaria, semestre, id_professor) 
                VALUES(:nome_disciplina, :carga_horaria, :semestre, :id_professor)";

        // Junta o código SQL à conexão do banco
        $stmt = $conexao->prepare($sql);

        // Diz o parâmetro e o tipo dos parâmetros
        $stmt->bindParam(':nome_disciplina', $nome_disciplina, PDO::PARAM_STR);
        $stmt->bindParam(':carga_horaria', $carga_horaria, PDO::PARAM_STR);
        $stmt->bindParam(':semestre', $semestre, PDO::PARAM_STR);
        $stmt->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);

        // Executa o SQL no banco de dados
        if ($stmt->execute()) {
            echo "<strong>OK!</strong> A disciplina $nome_disciplina foi cadastrada com sucesso!";
            echo '<button class="button"><a href="index.html">voltar</a></button>';
        } else {
            echo "Erro ao cadastrar disciplina.";
        }
    } else {
        echo "A idade não pode ser maior que 100 anos.";
    }
}

// Excluir 
if(isset($_GET['excluir'])) {
    $id_disciplina = $_GET['id_disciplina'];
    $sql = 'DELETE FROM disciplina WHERE id_disciplina = :id_disciplina;';
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_disciplina', $id_disciplina, PDO::PARAM_INT);

    // Executa o SQL no banco de dados
    if ($stmt->execute()) {
        echo "<strong>OK!</strong> A disciplina $id_disciplina foi excluída!";
        echo '<button class="button"><a href="index.php">Voltar</a>';
    } else {
        echo "Erro ao excluir disciplina.";
    }
}
}
?>