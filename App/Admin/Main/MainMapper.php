<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 04.02.19
 * Time: 13:59
 */

namespace App\Admin\Main;


use Core\Mapper;

class MainMapper extends Mapper
{
    public $validator;
    public function chooseMapper($key)
    {
        $result = false;

        if ($key === 'info') {
            $result = 'mapper';
        }

        if (!$result && ($key === 'characteristics')) {
            $result = 'characteristics';
        }
        return $result;
    }
}
