<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 08.02.19
 * Time: 9:16
 */

namespace Core\Mailer;

use Core\View;

class Mailer
{
    protected $sender;
    protected $receiver;
    protected $config;
    protected $transport;
    protected $mailer;
    public $view;
    protected $message;
    protected $messageView;

    public function __construct($sender)
    {
        $this->view = new View('mail_template', '../Core/Mailer/patterns/', []);
        $this->setConfig('../Core/Mailer/config/config.php');
        $this->setTransport($this->getConfig());
        $this->setMailer($this->getTransport());
        $this->setSender($sender);
    }

    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setMailer($transport)
    {
        $this->mailer = new \Swift_Mailer($transport);
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setConfig($config)
    {
        $this->config = require $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setTransport($config)
    {
        $this->transport = (new \Swift_SmtpTransport(
            $config['server'],
            $config['port']
        ))
            ->setUsername($config['user'])
            ->setPassword($config['password'])
            ->setEncryption($config['encryption']);
    }

    public function getTransport()
    {
        return $this->transport;
    }

    public function getMailer(): \Swift_Mailer
    {
        return $this->mailer;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getMessageView()
    {
        return $this->messageView;
    }

    public function renderMessageView($data, $pattern)
    {
        $this->messageView = $this->view->render($pattern, $data, MAIL_PATH);
    }

    public function renderMessage(array $from, array $to, $messageView)
    {
        $this->message = (new \Swift_Message('Dear Customer'))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($messageView, 'text/html');
    }

    public function send($data, $pattern, array $sendTo)
    {
        {
            $this->renderMessageView($data, $pattern);
            $messView = $this->getMessageView();
        }
        {
            $this->renderMessage(
                $this->getSender(),
                $sendTo,
                $messView
            );
            $result = $this->getMessage();
        }
        return $this->getMailer()->send($result);
    }
}
