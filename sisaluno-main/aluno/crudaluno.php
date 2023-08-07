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
function gerarFormularioCadastroAluno() {
    ?>
    <form method="POST" action="cadaluno.php">
        <label for="nome_aluno">Nome do aluno:</label>
        <input type="text" name="nome_aluno" required>
        <label for="idade_aluno">Idade do aluno:</label>
        <input type="text" name="idade_aluno" pattern="[0-9]+" title="Digite apenas números" required>
        <label for="datanascimento">Data de nascimento:</label>
        <input type="date" name="datanascimento" required>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" required>
        <label for="estatus">Estatus:</label>
        <input type="checkbox" name="estatus" required>
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" pattern="[0-9]+" title="Digite apenas números" required>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <input type="reset" value="Limpar">
    </form>

    <button class="button"><a href="index.php">Voltar</a></button>
   
    <?php
    function validarDadosFormulario() {
      // Valida o nome
      $nome_aluno = $_POST['nome_aluno'];
      if (empty($nome_aluno)) {
        echo "Por favor, digite o nome do aluno.";
        return false;
      }
    
      // Valida a idade
      $idade_aluno = $_POST['idade_aluno'];
      if (empty($idade_aluno)) {
        echo "Por favor, digite a idade do aluno.";
        return false;
      }
    
      // Valida a data de nascimento
      $datanascimento = $_POST['datanascimento'];
      if (empty($datanascimento)) {
        echo "Por favor, digite a data de nascimento do aluno.";
        return false;
      }
    
      // Valida o endereço
      $endereco = $_POST['endereco'];
      if (empty($endereco)) {
        echo "Por favor, digite o endereço do aluno.";
        return false;
      }
    
      // Valida o estatus
      $estatus = $_POST['estatus'];
      if (empty($estatus)) {
        echo "Por favor, selecione o estatus do aluno.";
        return false;
      }
    
      // Valida a matricula
      $matricula = $_POST['matricula'];
      if (empty($matricula)) {
        echo "Por favor, digite a matricula do aluno.";
        return false;
      }
    
      return true;
    }

      ## Permite acesso às variáveis dentro do arquivo `conexao.php`
    require_once('conexao.php');
    
    ## Cadastrar aluno
    if(isset($_POST['cadastrar'])) {
        // Código de cadastro de aluno (já fornecido anteriormente)
        // ...
    }
    
    ## Listar alunos
    function listarAlunos() {
      global $conexao;
      $sql = 'SELECT * FROM aluno;';
      $stmt = $conexao->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function atualizarAluno() {
      // Verifica se o ID do aluno foi enviado
      if (!isset($_POST['id_aluno'])) {
        echo "Por favor, selecione um aluno para atualizar.";
        return false;
      }
    
      // Pega os dados do formulário
      $id_aluno = $_POST['id_aluno'];
      $nome_aluno = $_POST['nome_aluno'];
      $idade_aluno = $_POST['idade_aluno'];
      $datanascimento = $_POST['datanascimento'];
      $endereco = $_POST['endereco'];
      $estatus = $_POST['estatus'];
      $matricula = $_POST['matricula'];
    
      // Verifica se os dados estão vazios
      if (empty($nome_aluno) || empty($idade_aluno) || empty($datanascimento) || empty($endereco) || empty($estatus) || empty($matricula)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        return false;
      }
    
      // Tenta atualizar o registro no banco de dados
      try {
        $conexao = require_once('conexao.php');
        $sql = "UPDATE aluno SET nome_aluno = :nome_aluno, idade_aluno = :idade_aluno, datanascimento = :datanascimento, endereco = :endereco, estatus = :estatus, matricula = :matricula WHERE id_aluno = :id_aluno";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome_aluno', $nome_aluno);
        $stmt->bindParam(':idade_aluno', $idade_aluno);
        $stmt->bindParam(':datanascimento', $datanascimento);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':estatus', $estatus);
        $stmt->bindParam(':matricula', $matricula);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->execute();
      } catch (PDOException $e) {
        echo "Erro ao atualizar o registro: $e";
        return false;
      }
    
      // Se tudo correr bem, redireciona o usuário para a página de listagem de alunos
      echo "<script>window.location.href = 'listaalunos.php';</script>";
      return true;
    }
  }
    ?>
    </body>
    </html>