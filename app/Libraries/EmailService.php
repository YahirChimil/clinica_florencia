<?php

namespace App\Libraries;

use SendGrid;
use SendGrid\Mail\Mail;

class EmailService
{
    protected $sendGrid;

    public function __construct()
    {
        $this->sendGrid = new SendGrid(getenv('SENDGRID_API_KEY'));
 // Usa aquí tu clave real
    }

    public function enviarCorreo($para, $asunto, $contenido)
    {
        $email = new Mail();
        $email->setFrom('xxkcronozsxx@gmail.com', 'Clinica Florencia');
        $email->setSubject($asunto);
        $email->addTo($para);
        $email->addContent('text/plain', strip_tags($contenido));
        $email->addContent('text/html', $contenido);

        try {
            $response = $this->sendGrid->send($email);
            return $response->statusCode();
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
