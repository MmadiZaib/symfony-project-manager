<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\ResetToken;
use Twig\Environment;

class ResetTokenSender
{
    private $mailer;
    private $twig;
    private $from;

    public function __construct(\Swift_Mailer $mailer, Environment $twig, array $from)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->from = $from;
    }

    public function send(Email $email, ResetToken $token)
    {
        $message = (new \Swift_Message('Password resetting'))
            ->setFrom('mail@app.test', 'APP')
            ->setTo($email->getValue())
            ->setBody($this->twig->render('mail/user/reset.html.twig', [
                'token' => $token->getToken()
            ]), 'text/html');

        if (!$this->mailer->send($message)) {
            throw new \RuntimeException('Unable to send message.');
        }
    }
}
