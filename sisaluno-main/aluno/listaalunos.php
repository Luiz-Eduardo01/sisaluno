<?php
require_once('conexao.php');

$retorno = $conexao->prepare('SELECT * FROM Aluno');
$retorno->execute();

?>       
        <table> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>IDADE</th>
                    <th>ALTERAR</th>
                    <th>EXCLUIR</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($retorno->fetchall() as $value) { ?>
                <tr>
                    <td> <?php echo $value['idaluno'] ?>   </td> 
                    <td> <?php echo $value['nome']?>  </td> 
                    <td> <?php echo $value['idade']?> </td> 

                    <td>
                        <form method="POST" action="altaluno.php">
                            <input name="id" type="hidden" value="<?php echo $value['idaluno'];?>"/>
                            <button name="alterar"  type="submit">Alterar</button>
                        </form>
                    </td> 

                    <td>
                        <form method="GET" action="crudaluno.php">
                            <input name="id" type="hidden" value="<?php echo $value['idaluno'];?>"/>
                            <button name="excluir"  type="submit">Excluir</button>
                        </form>
                    </td> 
                </tr>
                <?php  }  ?> 
            </tbody>
        </table>
<?php         
    echo "<button class='button button3'><a href='index.php'>Voltar</a></button>";
?>