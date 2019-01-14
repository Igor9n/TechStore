<?php

namespace Stereolog;

use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MyLogger
{
    public $logger;
    public function __construct($name, $directory){
        $this->logger = new Logger($name);
        $this->logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'].$directory));
        $this->logger->pushHandler(new FirePHPHandler());
    }
    public function logInfo($data){
        $this->logger->addInfo($data, [
            'User browser' => $_SERVER['HTTP_USER_AGENT'],
            'User IP' => $_SERVER['REMOTE_ADDR']]);
    }
}