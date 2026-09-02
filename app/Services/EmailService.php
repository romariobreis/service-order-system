<?php

namespace App\Services;

class EmailService
{
  public function sendServiceFinishedEmail(string $toEmail, string $userName, string $description): bool
  {
    $subject = "Serviço Finalizado - JM Informática";
    $message = "Olá {$userName},\n\nInformamos que o serviço '{$description}' foi finalizado com sucesso em nosso sistema e sua comissão foi contabilizada.\n\nAtenciosamente,\nEquipe JM Informática";
    $headers = "From: sistema@jminformatica.com\r\n";

    // On a real server, uncomment the line below:
    // return mail($toEmail, $subject, $message, $headers);
    return true;
  }
}
