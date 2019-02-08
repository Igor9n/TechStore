<?php

namespace Core;

class View
{
    protected $template;
    protected $content;
    protected $elements;

    public function __construct($template = 'template', $templatePath = USER_TEMPLATE, $elements = USER_ELEMENTS)
    {
        $this->setLayoutElements($elements);
        $this->setTemplate($template, $templatePath);
    }

    public function initView($content, $data = [])
    {
        $view = $this->render($content, $data);
        Response::sendResponse($view);
    }

    public function render($content, $data = [], $viewPath = USER_VIEWS)
    {
        $this->setContent($content, $viewPath, $data);

        ob_start();
        extract($data);
        include $this->getTemplate();
        $view = ob_get_clean();

        return $view;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($name, $path, $data)
    {
        ob_start();
        extract($data);
        include $path . $name . PHP_EXT;
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
