<?php 

// Criar uma função para criar a conexão com o banco de dados
function criarConexao() {
    // Definir as constantes com as credenciais de acesso ao banco de dados
    define('HOST', 'localhost');
    define('USUARIO', 'root'); // Substitua pelo nome de usuário do MySQL
    define('SENHA', 'ifbaiano'); // Substitua pela senha do MySQL
    define('DBNAME', 'escola'); // Substitua pelo nome do banco de dados "escola" que você deseja criar

    // Criar a conexão com o banco de dados usando o PDO e a porta do banco de dados
    // Utilizar o Try/Catch para verificar a conexão.
    try {
        $conexao = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USUARIO, SENHA);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (PDOException $e) {
        echo "Erro: Conexão com o banco de dados não foi realizada com sucesso. Erro gerado " . $e->getMessage();
        exit();
    }
}

// Criar a conexão com o banco de dados
$conexao = criarConexao();

// Criação do banco de dados e das tabelas 
$sql = "CREATE DATABASE IF NOT EXISTS " . DBNAME;
$conexao->exec($sql);
$conexao->query("USE " . DBNAME);

$sql = "CREATE TABLE IF NOT EXISTS Aluno (
        id_aluno SMALLINT PRIMARY KEY AUTO_INCREMENT,
        nome_aluno VARCHAR(100),
        idade_aluno SMALLINT,
        datanascimento DATE,
        endereco VARCHAR(100),
        estatus TINYINT(1),
        matricula VARCHAR(11)
    )";
$conexao->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS Professor (
        id_professor SMALLINT PRIMARY KEY AUTO_INCREMENT,
        nome_professor VARCHAR(100),
        idade_professor SMALLINT,
        cpf VARCHAR(11),
        siape SMALLINT,
    )";
$conexao->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS Disciplina (
        id_disciplina SMALLINT PRIMARY KEY AUTO_INCREMENT,
        disciplina VARCHAR(80),
        ch CHAR(3),
        semestre VARCHAR(5),
        id_professor SMALLINT,
        FOREIGN KEY (id_professor) REFERENCES Professor(id_professor)
    )";
$conexao->exec($sql);

?>