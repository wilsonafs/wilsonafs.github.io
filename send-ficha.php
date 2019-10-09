<?php
    $nome = $_POST['userName'];
    $aniversario = $_POST['birthDate'];
    $empresa = $_POST['company'];
    $andar = $_POST['floor'];
    $departamento = $_POST['department'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $cpf = $_POST['cpf'];

    mail("wilsonafs@hotmail.com", "Uma ficha vinda do site!", 
    "Uma ficha vinda do site!

    Dados pessoais do usuário:

    Nome completo: $nome
    Aniversário: $aniversario
    Empresa: $empresa
    Andar: $andar
    Departamento: $departamento
    E-mail: $email
    Whatsapp: $whatsapp
    CPF: $cpf

    Confirmação de leitura do termo de entrega:

    Frutas que o usuário NÃO gostaria de receber:

    Confirmação de leitura do termo de pagamento:
    

    ")
?>

<script> window.location.href = "ficha_enviada.html"; </script>