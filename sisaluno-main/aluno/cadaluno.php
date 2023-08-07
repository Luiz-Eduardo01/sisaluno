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
function gerarFormularioCadastroAluno() {
    ?>
<form method="post" action="crudaluno.php">
    <label for="nome">Nome do aluno:</label>
    <input type="text" name="nome_aluno" required>
    <label for="idade">Idade:</label>
    <input type="text" name="idade" pattern="[0-9]+" title="Digite apenas números" required>
    <label for="datanascimento">Data de Nascimento:</label>
    <input type="date" name="datanascimento" required>
    <label for="endereco">Endereço:</label>
    <input type="text" name="endereco" required>
    <label for="estatus">Estatus:</label>
    <input type="checkbox" name="estatus" value="1"> Ativo
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" pattern="[0-9]+" title="Digite apenas números" required>
    <input type="submit" name="cadastrar" value="Cadastrar">
    <input type="reset" value="Limpar">
</form>

<button class="button"><a href="index.php">Voltar</a></button>

<?php
}

function gerarFormularioAtualizarAluno($aluno) {
    $form = '<form method="POST" action="atualizaaluno.php">';
    $form .= '<input type="hidden" name="id_aluno" value="' . $aluno['id_aluno'] . '">';
    $form .= '<label>Nome:</label>';
    $form .= '<input type="text" name="nome_aluno" value="' . $aluno['nome_aluno'] . '">';
    $form .= '<label>Idade:</label>';
    $form .= '<input type="number" name="idade_aluno" value="' . $aluno['idade_aluno'] . '">';
    $form .= '<label>Data de Nascimento:</label>';
    $form .= '<input type="date" name="datanascimento" value="' . $aluno['datanascimento'] . '">';
    $form .= '<label>Endereço:</label>';
    $form .= '<input type="text" name="endereco" value="' . $aluno['endereco'] . '">';
    $form .= '<label>Status:</label>';
    $form .= '<input type="radio" name="estatus" value="1" ' . ($aluno['estatus'] == 1 ? 'checked' : '') . '> Ativo';
    $form .= '<input type="radio" name="estatus" value="0" ' . ($aluno['estatus'] == 0 ? 'checked' : '') . '> Inativo';
    $form .= '<label for="matricula">Matrícula:</label>';
    $form .= '<input type="text" name="matricula" id="matricula" value="' . $aluno['matricula'] . '">';
    $form .= '<input type="hidden" name="id_aluno" value="' . $aluno['id_aluno'] . '">';
    $form .= '<button type="submit" class="button">Atualizar Aluno</button>';
    $form .= '</form>';
    return $form;
}

if(isset($_POST['cadastrar'])){
    require_once('conexao.php');

    // Dados recebidos pelo método POST
    $nome_aluno = $_POST["nome_aluno"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $datanascimento = $_POST["datanascimento"];
    $status = $_POST["status"];
    $matricula = $_POST["matricula"];

    // Verifica se a idade é maior que 100 anos
    if (verificarIdade($idade_aluno) === false) {
      echo "A idade não pode ser maior que 100 anos.";
      return;
    }

    // Código SQL
    $sql = "INSERT INTO Aluno(nome_aluno, cpf, endereco, datanascimento, status, matricula) 
            VALUES(:nome_aluno, :cpf, :endereco, :datanascimento, :status, :matricula)";

    // Junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    // Diz o parâmetro e o tipo dos parâmetros
    $stmt->bindParam(':nome_auno', $nome_aluno, PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
    $stmt->bindParam(':datanascimento', $datanascimento, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':matricula', $matricula, PDO::PARAM_STR);

    // Executa o SQL no banco de dados
    if ($stmt->execute()) {
        echo "<strong>OK!</strong> O aluno $nome_aluno foi cadastrado com sucesso!";
        echo " <button class='button'><a href='index.php'>Voltar</a></button>";
    } else {
        echo "Erro ao cadastrar aluno.";
    }
}
?>
<script>
function validarDadosFormulario() {
    // Validar nome
    var nome_aluno = document.getElementById("nome_aluno").value;
    if (nome_aluno == "") {
        echo "Por favor, digite o nome do aluno.";
        return false;
    }

    // Validar idade
    var idade = document.getElementById("idade").value;
    if (idade == "") {
        alert("Por favor, digite a idade do professor.");
        return false;
    }

    // Validar endereço
    if (endereco == "") {
        echo "Por favor, digite o endereço do aluno.";
        return false;
    }

    // Validar data de nascimento
    if (datanascimento == "") {
        echo "Por favor, digite a data de nascimento do aluno.";
        return false;
    }

    // Validar estatus
    if (estatus == "") {
        echo "Por favor, selecione o status do aluno.";
        return false;
    }

    // Validar matrícula
    if (matricula == "") {
        echo "Por favor, digite a matrícula do aluno.";
        return false;
    }

    return true;
}
  </script>

</body>
</html>