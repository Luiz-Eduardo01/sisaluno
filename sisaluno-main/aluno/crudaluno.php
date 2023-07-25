<?php
##permite acesso as variáveis dentro do arquivo conexao
require_once('conexao.php');

// Criação do banco de dados e das tabelas (se ainda não existirem)
$sql = "CREATE DATABASE IF NOT EXISTS escola";
$conexao->exec($sql);
$conexao->query("USE escola");

$sql = "CREATE TABLE IF NOT EXISTS Aluno (
    idaluno SMALLINT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    idade SMALLINT,
    datanascimento DATE,
    endereco VARCHAR(100),
    estatus TINYINT(1),
    matricula VARCHAR(11)
)";
$conexao->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS Professor (
    idprofessor SMALLINT PRIMARY KEY AUTO_INCREMENT,
    nomeprof VARCHAR(100),
    cpf VARCHAR(11),
    siape SMALLINT,
    idade SMALLINT
)";
$conexao->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS Disciplina (
    iddisciplina SMALLINT PRIMARY KEY AUTO_INCREMENT,
    disciplina VARCHAR(80),
    ch CHAR(3),
    semestre VARCHAR(5),
    idprofessor SMALLINT,
    FOREIGN KEY (idprofessor) REFERENCES Professor(idprofessor)
)";
$conexao->exec($sql);


##cadastrar
if(isset($_GET['cadastrar'])){
    ##dados recebidos pelo método GET
    $nome = $_GET["nomealuno"];
    $idade = $_GET["idade"];

    ##codigo SQL
    $sql = "INSERT INTO aluno(nome,idade) 
            VALUES('$nome','$idade')";

    ##junta o código SQL à conexão do banco
    $sqlcombanco = $conexao->prepare($sql);

    ##executa o SQL no banco de dados
    if($sqlcombanco->execute()) {
        echo "<strong>OK!</strong> O aluno $nome foi incluído com sucesso!!!"; 
        echo "<button class='button'><a href='index.php'>Voltar</a></button>";
    }
}

##alterar
if(isset($_POST['update'])){
    ##dados recebidos pelo método POST
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $id = $_POST["id"];
   
    ##codigo SQL
    $sql = "UPDATE aluno SET nome = :nome, idade = :idade WHERE idaluno = :id";
   
    ##junta o código SQL à conexão do banco
    $stmt = $conexao->prepare($sql);

    ##diz o parâmetro e o tipo do parâmetros
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':idade', $idade, PDO::PARAM_INT);
    $stmt->execute();
 
    if($stmt->execute()) {
        echo "<strong>OK!</strong> O aluno $nome foi alterado com sucesso!!!"; 
        echo "<button class='button'><a href='index.html'>Voltar</a></button>";
    }
}

##Excluir
if(isset($_GET['excluir'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM aluno WHERE idaluno = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if($stmt->execute()) {
        echo "<strong>OK!</strong> O aluno com ID $id foi excluído!!!"; 
        echo "<button class='button'><a href='listaalunos.php'>Voltar</a></button>";
    }
}
?>
