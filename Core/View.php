<?php
namespace Core;

class View
{
    function generate($template, $content, $data = [], $path = "../App/views/")
    {
        ob_start();
        extract($data);
        include $path.$template;
        ob_end_flush();
    }
}