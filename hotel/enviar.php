<?php require_once("sistema/conexao.php"); 

$destinatario = $email_sistema;
$assunto = $nome_sistema . ' - Email do Site';
$mensagem = utf8_decode('Nome: '.$_POST['nome']. "\r\n"."\r\n" . 'Telefone: '.$_POST['telefone']. "\r\n"."\r\n" . 'Mensagem: ' . "\r\n"."\r\n" .$_POST['mensagem']);
$cabecalhos = "From: ".$_POST['email'];
@mail($destinatario, $assunto, $mensagem, $cabecalhos);

echo 'Enviado';

?>