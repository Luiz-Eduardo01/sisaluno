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
function gerarFormularioCadastroProfessor() {
    ?>
    <form method="POST" action="cadprofessor.php">
        <label for="nome_professor">Nome do professor:</label>
        <input type="text" name="nome_professor" required>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" required pattern="[0-9]+" title="Digite apenas números">
        <label for="siape">SIAPE:</label>
        <input type="text" name="siape" required pattern="[0-9]+" title="Digite apenas números">
        <label for="idade_professor">Idade:</label>
        <input type="text" name="idade" required pattern="[0-9]+" title="Digite apenas números">
        <input type="submit" name="cadastrar" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>

    <button class="button"><a href="index.php">Voltar</a></button>
    
    <?php
}

function gerarFormularioAtualizarProfessor($professor) {
    $form = '<form method="POST" action="atualizaprofessor.php">';
    $form .= '<input type="hidden" name="id_professor" value="' . $professor['id_professor'] . '">';
    $form .= '<label>Nome:</label>';
    $form .= '<input type="text" name="nome_professor" value="' . $professor['nome_professor'] . '">';
    $form .= '<label>CPF:</label>';
    $form .= '<input type="text" name="cpf" value="' . $professor['cpf'] . '">';
    $form .= '<label>SIAPE:</label>';
    $form .= '<input type="number" name="siape" value="' . $professor['siape'] . '">';
    $form .= '<label>Idade:</label>';
    $form .= '<input type="number" name="idade_professor" value="' . $professor['idade_professor'] . '">';
    $form .= '<button type="submit" class="button">Atualizar Professor</button>';
    $form .= '</form>';
    return $form;
}


if(isset($_POST['cadastrar'])){
    require_once('conexao.php');

    // Dados recebidos pelo método POST
    $nome_professor = $_POST["nome_professor"];
    $cpf = $_POST["cpf"];
    $siape = $_POST["siape"];
    $idade_professor = $_POST["idade_professor"];

    // Verifica se a idade é maior que 100 anos
    function verificarIdade($idade_professor) {
        if ($idade_professor > 100) {
          return false;
        } else {
          return true;
        }
      }     
        // Código SQL
        $sql = "INSERT INTO Professor(nome_professor, cpf, siape, idade_professor) 
                VALUES(:nome_professor, :cpf, :siape, :idade_professor)";

        // Junta o código SQL à conexão do banco
        $stmt = $conexao->prepare($sql);

        // Diz o parâmetro e o tipo dos parâmetros
        $stmt->bindParam(':nome_professor', $nome_professor, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':siape', $siape, PDO::PARAM_INT);
        $stmt->bindParam(':idade_professor', $idade_professor, PDO::PARAM_INT);

        // Executa o SQL no banco de dados
        if ($stmt->execute()) {
            echo "<strong>OK!</strong> O professor $nome_professor foi cadastrado com sucesso!";
            echo " <button class='button'><a href='index.php'>Voltar</a></button>";
        } else {
            echo "Erro ao cadastrar professor.";
        }
    } else {
        echo "A idade não pode ser maior que 100 anos.";
    }
?>

<script>
function validarDadosFormulario() {
    // Validar nome
    var nome_professor = document.getElementById("nome_professor").value;
    if (nome_professor == "") {
        alert("Por favor, digite o nome do professor.");
        return false;
    }

    // Validar idade
    var idade_professor = document.getElementById("idade_professor").value;
    if (idade_professor == "") {
        alert("Por favor, digite a idade do professor.");
        return false;
    }

    // Validar CPF
    var cpf = document.getElementById("cpf").value;
    if (cpf == "") {
        alert("Por favor, digite o CPF do professor.");
        return false;
    }

    // Validar SIAPE
    var siape = document.getElementById("siape").value;
    if (siape == "") {
        alert("Por favor, digite o SIAPE do professor.");
        return false;
    }

    return true;
}
</script>

</body>
</html>