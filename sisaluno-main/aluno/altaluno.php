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
require_once('conexao.php');

$id = $_POST['id'];

##sql para selecionar apenas um aluno
$sql = "SELECT * FROM Aluno WHERE idaluno = :id";

# junta o sql a conexão do banco
$retorno = $conexao->prepare($sql);

##diz o parâmetro e o tipo do parâmetro
$retorno->bindParam(':id', $id, PDO::PARAM_INT);

#executa a estrutura no banco
$retorno->execute();

#transforma o retorno em array
$array_retorno = $retorno->fetch();
   
##armazena retorno em variáveis
$nome = $array_retorno['nome'];
$idade = $array_retorno['idade'];
?>

<form method="POST" action="crudaluno.php">
    <label for="">Nome do aluno:</label>
    <input type="text" name="nome" value="<?php echo $nome; ?>">
    <label for="">Idade:</label>
    <input type="text" name="idade" value="<?php echo $idade; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="update" value="Alterar">
</form>

</body>
</html>