<?php
$url = "http://api.wordmensagens.com.br/send-doc";


$post_request = array(
  'instance' => $instancia,
  'to' => $telefone_envio,
  'token' => $token,
  'message' => $mensagem,
  "url" => $url_envio
);

$post_request = json_encode($post_request);
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_request);
  $result = curl_exec($ch);
  curl_close($ch);
 

 echo $result;

?>
  