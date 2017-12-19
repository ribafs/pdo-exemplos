<?php
require_once('header.php');
?>

<div align="center">
<a href="add.php" class="btn btn-primary">Novo Cliente</a>
</div>
<br>

<?php
require_once('connection.php');

try{
    $stmte = $pdo->query("SELECT * FROM $tabela order by nome");
    $executa = $stmte->execute();
?>
<div class="container">
    <table align="center" class="table table-bordered table-responsive table-hover">
    <tr><td><b>ID</td><td><b>Nome</td><td><b>Email</td><td><b>Nascimento</td><td><b>CPF</td><td colspan="2" align="center">Ação</td></tr>

<?php
    if($executa){
        while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ // Para recuperar um ARRAY utilize PDO::FETCH_ASSOC 
?>
            <tr><td><?=$reg->id?></td>
            <td><?=$reg->nome?></td>
            <td><?=$reg->email?></td>
            <td><?=$reg->data_nasc?></td>
            <td><?=$reg->cpf?></td>
            <td><a href="update.php?id=<?=$reg->id?>"><i class="glyphicon glyphicon-edit" title="Editar"></a></td>
            <td><a href="delete.php?id=<?=$reg->id?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td></tr>
<?php
       }
       print '</table>';
print '</div>';
    }else{
           echo 'Erro ao inserir os dados';
    }
}catch(PDOException $e){
      echo $e->getMessage();
}

require_once('footer.php');

