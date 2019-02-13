<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:13
 */

namespace Core;

use Core\Mailer\Mailer;

class Mapper
{
    protected $mailer;
    protected $model;
    protected $mapper;
    protected $validator;

    public function __construct()
    {
        $this->mailer = new Mailer(TECH_STORE);
    }

    /**
     * @param $array
     * @return array
     */
    protected function makeSimpleArray(array $array): array
    {
        $result = [];
        foreach ($array as $value) {
            if (isset($value)) {
                foreach ($value as $var) {
                    $result[] = $var;
                }
            }
        }
        return $result;
    }
}