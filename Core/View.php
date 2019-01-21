<?php
namespace Core;

class View
{
    function generate($template, $content, $data = [])
    {
        ob_start();
        extract($data);
        include 'App/views/'.$template;
        ob_end_flush();
    }
}