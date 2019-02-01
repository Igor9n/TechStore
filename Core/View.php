<?php

namespace Core;

class View
{
    protected $path;
    protected $template;
    protected $content;
    protected $elements;

    public function render($content, $data = [], $template = 'template', $elements = USER_ELEMENTS)
    {
        $this->setLayoutElements($elements);
        $this->setContent($content, USER_VIEWS);
        $this->setTemplate($template, USER_TEMPLATE);

        ob_start();
        extract($data);
        include $this->getTemplate();
        $view = ob_get_clean();

        Response::sendResponse($view);
    }


    public function generate($template, $content, $data = [], $path = "../App/User/views/")
    {
        extract($data);
        ob_start();
        include $path . $template;
        $result = ob_get_clean();
        echo $result;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($title, $path)
    {
        ob_start();
        include $path . $title . PHP_EXT;
        $this->content = ob_get_clean();
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setTemplate($title, $path)
    {
        $this->template = $path . $title . PHP_EXT;
    }

    public function setLayoutElement(string $title, string $path): void
    {
        ob_start();
        include $path . $title . PHP_EXT;
        $this->elements[$title] = ob_get_clean();
    }

    public function setLayoutElements(array $elements)
    {
        foreach ($elements as $title => $path) {
            $this->setLayoutElement($title, $path);
        }
    }

    public function getLayoutElement($title)
    {
        return $this->elements[$title];
    }
}