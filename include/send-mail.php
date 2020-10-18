<?php
$nome = $_POST['cf_name'];
$email = $_POST['cf_email'];
$telefone = $_POST['cf_telefone'];
$telefonia = $_POST['cf_servico'];
$operadora = $_POST['cf_operadora'];
$pabx = $_POST['cf_pabx'];
$mensagem = $_POST['cf_msg'];

mail("wilsonafs@hotmail.com", "Uma mensagem vinda do site!","

Uma mensagem vinda do site!

Nome: $nome
E-mail: $email
Telefone: $telefone
Gasto com telefonia: $telefonia
Operadora de telefone atual: $operadora
Utiliza PABX: $pabx
Mensagem do usuario: $mensagem")

?>

<script> window.location.href = '../leads.html'; </script>";