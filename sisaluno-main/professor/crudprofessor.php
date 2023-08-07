<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <input type="text" name="cpf" pattern="[0-9]+" title="Digite apenas números" required>
        <label for="siape">SIAPE:</label>
        <input type="text" name="siape" pattern="[0-9]+" title="Digite apenas números" required>
        <label for="idade_professor">Idade do professor:</label>
        <input type="text" name="idade_professor" pattern="[0-9]+" title="Digite apenas números" required>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>

    <button class="button"><a href="index.php">Voltar</a></button>

<?php
function validarDadosFormulario() {
      // Valida o nome
      $nome_professor = $_POST['nome_professor'];
      if (empty($nome_professor)) {
        echo "Por favor, digite o nome do professor.";
        return false;
      }
    
      // Valida a idade
      $idade_professor = $_POST['idade_professor'];
      if (empty($idade_professor)) {
        echo "Por favor, digite a idade do professor.";
        return false;
      }
    
      // Valida o CPF
      $cpf = $_POST['cpf'];
      if (empty($cpf)) {
        echo "Por favor, digite o CPF do professor.";
        return false;
      }
    
      // Valida o SIAPE
      $siape = $_POST['siape'];
      if (empty($siape)) {
        echo "Por favor, digite o SIAPE do professor.";
        return false;
      }
    
      return true;
    }
## Permite acesso às variáveis dentro do arquivo `conexao.php`
require_once('conexao.php');

## Permite acesso às variáveis dentro do arquivo `conexao.php`
require_once('conexao.php');

## Cadastrar professor
if(isset($_POST['cadastrar'])) {
    // Código de cadastro de professor (já fornecido anteriormente)
    // ...
}

## Listar professores
function listarProfessores() {
    global $conexao;
    $sql = 'SELECT * FROM professor;';
    $stmt = $conexao->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function atualizarProfessor() {
    // Verifica se o ID do professor foi enviado
    if (!isset($_POST['id_professor'])) {
      echo "Por favor, selecione um professor para atualizar.";
      return false;
    }
  
    // Pega os dados do formulário
    $id_professor = $_POST['id_professor'];
    $nome_professor = $_POST['nome_professor'];
    $cpf = $_POST['cpf'];
    $siape = $_POST['siape'];
    $idade_professor = $_POST['idade_professor'];
  
    // Verifica se os dados estão vazios
    if (empty($nome_professor) || empty($cpf) || empty($siape) || empty($idade_professor)) {
      echo "Por favor, preencha todos os campos obrigatórios.";
      return false;
    }
  
    // Tenta atualizar o registro no banco de dados
    try {
      $conexao = require_once('conexao.php');
      $sql = "UPDATE professor SET nome_professor = :nome_professor, cpf = :cpf, siape = :siape, idade_professor = :idade_professor WHERE id_professor = :id_professor";
      $stmt = $conexao->prepare($sql);
      $stmt->bindParam(':nome_professor', $nome_professor);
      $stmt->bindParam(':cpf', $cpf);
      $stmt->bindParam(':siape', $siape);
      $stmt->bindParam(':idade_professor', $idade_professor);
      $stmt->bindParam(':id_professor', $id_professor);
      $stmt->execute();
    } catch (PDOException $e) {
      echo "Erro ao atualizar o registro: $e";
      return false;
    }
  
    // Se tudo correr bem, redireciona o usuário para a página de listagem de professores
    echo "<script>window.location.href = 'listadeprofessores.php';</script>";
    return true;
  }
}
?>
</body>
</html>