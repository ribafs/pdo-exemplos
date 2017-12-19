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
    $sql = "SELECT * FROM $tabela";
    $stmte = $pdo->query($sql);
    $executa = $stmte->execute();
?>
<div class="container">
    <table align="center" class="table table-bordered table-responsive table-hover">
    <tr>
<?php
        $sth = $pdo->query($sql);
        $numfields = $sth->columnCount();
        
        for($x=0;$x<$numfields;$x++){
            $meta = $sth->getColumnMeta($x);
            $field = $meta['name'];
?>
        <td><b><?=ucfirst($field)?></td>
<?php
        }
print '<td colspan="2" align="center"><b>Ação</td></tr><tr>';
    if($executa){
        while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ // Para recuperar um ARRAY utilize PDO::FETCH_ASSOC 
            for($x=0;$x<$numfields;$x++){
                $meta = $sth->getColumnMeta($x);
                $field = $meta['name'];

?>
            <td><?=$reg->$field?></td>
<?php
            }
?>
            <td><a href="update.php?id=<?=$reg->id?>"><i class="glyphicon glyphicon-edit" title="Editar"></a></td>
            <td><a href="delete.php?id=<?=$reg->id?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td></tr>
<?php
       }
?>
      </table>
</div>
<?php
    }else{
           echo 'Erro ao inserir os dados';
    }
}catch(PDOException $e){
      echo $e->getMessage();
}

require_once('footer.php');

