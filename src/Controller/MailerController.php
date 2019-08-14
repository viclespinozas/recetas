<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MailerController extends AbstractController
{
    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('no-reply@vese.com')
            // ->to('victorlespinozas@gmail.com')
            // ->cc('cc@example.com')
            ->bcc('yeimar.pich1@gmail.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Matrimonio Yeimar & Víctor')
            // ->text('Sending emails is fun again!')
            // ->attachFromPath('C:\xampp73\htdocs\recetas\public\images\invitation.png')
            ->embedFromPath('C:\xampp73\htdocs\recetas\public\images\invitation.png', 'footer-signature')
            ->html('<img src="cid:footer-signature"> ...');

        $mailer->send($email);

        return new Response(
            '<html><body>Lucky number: </body></html>'
        );
    }
}