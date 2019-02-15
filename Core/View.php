<?php

namespace Core;

class View
{
    protected $template;
    protected $content;
    protected $elements;

    /**
     * View constructor.
     * @param string $template
     * @param string $templatePath
     * @param array $elements
     */
    public function __construct($template = 'template', $templatePath = USER_TEMPLATE, $elements = USER_ELEMENTS)
    {
        $this->setLayoutElements($elements);
        $this->setTemplate($template, $templatePath);
    }

    /**
     * @param $content
     * @param array $data
     */
    public function initView($content, $data = [])
    {
        $view = $this->render($content, $data);
        Response::sendResponse($view);
    }

    /**
     * @param $content
     * @param array $data
     * @param string $viewPath
     * @return false|string
     */
    public function render($content, $data = [], $viewPath = USER_VIEWS)
    {
        $this->setContent($content, $viewPath, $data);

        ob_start();
        extract($data);
        include $this->getTemplate();

        return ob_get_clean();
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $name
     * @param $path
     * @param $data
     */
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

    /**
     * @param $title
     * @param $path
     */
    public function setTemplate($title, $path)
    {
        $this->template = $path . $title . PHP_EXT;
    }

    /**
     * @param string $title
     * @param string $path
     */
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

    /**
     * @param $title
     * @return mixed
     */
    public function getLayoutElement($title)
    {
        return $this->elements[$title];
    }
}
