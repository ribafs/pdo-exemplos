<?php
require_once('header.php');
?>

<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

        <table class="table table-bordered table-responsive table-hover">    
            <form method="post" action="add.php">           
            <tr><td>Nome</td><td><input type="text" name="nome"></td></tr>
            <tr><td>E-mail</td><td><input type="text" name="email"></td></tr>
            <tr><td>Nascimento</td><td><input type="text" name="data_nasc"></td></tr>
            <tr><td>CPF</td><td><input type="text" name="cpf"></td></tr>
            <tr><td></td><td><input class="btn btn-primary" name="enviar" type="submit" value="Cadastrar">&nbsp;&nbsp;&nbsp;
            <input class="btn btn-warning" name="enviar" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
            </form>
        </table>
        </div>
    </div>
</div>

<?php

require_once('connection.php');

if(isset($_POST['enviar'])){
$nome = $_POST['nome'];
$email = $_POST['email'];
$data_nasc = $_POST['data_nasc'];
$cpf = $_POST['cpf'];

   try{
       $stmte = $pdo->prepare("INSERT INTO clientes(nome,email,data_nasc,cpf) VALUES (?, ?, ?, ?)");
       $stmte->bindParam(1, $nome , PDO::PARAM_STR);
       $stmte->bindParam(2, $email , PDO::PARAM_STR);
       $stmte->bindParam(3, $data_nasc , PDO::PARAM_STR);
       $stmte->bindParam(4, $cpf , PDO::PARAM_STR);
       $executa = $stmte->execute();
 
       if($executa){
           echo 'Dados inseridos com sucesso';
		   header('location: index.php');
       }
       else{
           echo 'Erro ao inserir os dados';
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
}
require_once('footer.php');
?>

