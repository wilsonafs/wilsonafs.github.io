<?php
$recipient = "enursing.ap@gmail.com";
$subject = "Usuario recusou participar da pesquisa";
$mailheader = "Usuario recusou participar da pesquisa: $email \r\n";
mail($recipient, $subject, $mailheader) or die("Error!");

   

header("Location:https://www.bmexs.com/src/views/content.html")


?>
