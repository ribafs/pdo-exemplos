<?php
require_once('connection.php');

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, nome,email,data_nasc,cpf from clientes WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);
$nome = $reg->nome;
$email = $reg->email;
$data_nasc = $reg->data_nasc;
$cpf = $reg->cpf;

require_once('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">
                <tr><td><b>Nome</td><td><input type="text" name="nome" value="<?=$nome?>"></td></tr>
                <tr><td><b>E-mail</td><td><input type="text" name="email" value="<?=$email?>"></td></tr>
                <tr><td><b>Nascimento</td><td><input type="text" name="data_nasc" value="<?=$data_nasc?>"></td></tr>
                <tr><td><b>CPF</td><td><input type="text" name="cpf" value="<?=$cpf?>"></td></tr>
                <input name="id" type="hidden" value="<?=$id?>">
                <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
                </table>
            </form>
        </div>
    <div>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nasc = $_POST['data_nasc'];
    $cpf = $_POST['cpf'];

    $sql = "UPDATE $tabela SET nome = :nome, email=:email, data_nasc=:data_nasc, cpf=:cpf WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $sth->bindParam(':nome', $_POST['nome'], PDO::PARAM_INT);   
    $sth->bindParam(':email', $_POST['email'], PDO::PARAM_INT);   
    $sth->bindParam(':data_nasc', $_POST['data_nasc'], PDO::PARAM_INT);   
    $sth->bindParam(':cpf', $_POST['cpf'], PDO::PARAM_INT);   

   if($sth->execute()){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
require_once('footer.php');
?>

