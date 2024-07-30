<?php
if (!empty($_POST['mensagem'])) {
    // Informações do formulário
    $assunto = "Denúncia através do formulário da campanha de assédio";
    $mensagem = $_POST['mensagem'];

    // Configurações de e-mail
    $destinatario = 'ouvidoria@statledbrasil.com.br'; // Corrija o endereço de e-mail
    $remetente = 'no-reply@inducta.com.br'; // Insira um endereço de e-mail válido para o cabeçalho "From"
    $cabecalhos = "From: $remetente" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Construir o corpo da mensagem
    $corpo .= "Assunto: $assunto\n";
    $corpo .= "Mensagem: $mensagem\n";

    // Envio do e-mail
    ini_set('sendmail_from', 'no-reply@inducta.com.br');
    $enviado = mail($destinatario, $assunto, $corpo, $cabecalhos);

    // Verifica se o e-mail foi enviado com sucesso
    if ($enviado) {
        header('Content-Type: application/json');
        echo json_encode(array('sucesso' => true));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('sucesso' => false));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('sucesso' => false, 'erro' => 'Todos os campos do formulário devem ser preenchidos.'));
}
