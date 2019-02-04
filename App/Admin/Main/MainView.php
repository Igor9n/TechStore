<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 23.01.19
 * Time: 11:00
 */

namespace App\Admin\Main;

use Core\Response;
use Core\View;

class MainView extends View
{
    public function render($content, $data = [], $template = 'admin_template', $elements = ADMIN_ELEMENTS)
    {
        $this->setLayoutElements($elements);
        $this->setContent($content, ADMIN_VIEWS, $data);
        $this->setTemplate($template, ADMIN_TEMPLATE);

        ob_start();
        extract($data);
        include $this->getTemplate();
        $view = ob_get_clean();

        Response::sendResponse($view);
    }
}