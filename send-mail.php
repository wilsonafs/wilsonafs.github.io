<?php
$nome = $_POST['cf_name'];
$email = $_POST['cf_email'];
$telefone = $_POST['cf_telefone'];
$servico = $_POST['cf_servico'];
$mensagem = $_POST['cf_msg'];

mail("wilsonafs@hotmail.com", "Uma mensagem vinda do site!","

Uma mensagem vinda do site!

Nome: $nome
E-mail: $email
Telefone: $telefone
Tipo do serviço: $servico
Mensagem do usuário: $mensagem")

?>

<script> window.location.href = 'orcamento_ok.html'; </script>";