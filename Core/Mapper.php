<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 14.01.19
 * Time: 17:13
 */

namespace Core;


class Mapper
{
    protected $model;
    protected $mapper;

    protected function makeSimpleArray($array) {
        $result = [];
        foreach ($array as $value){
            if (isset($value)){
                foreach ($value as $var){
                    $result[] = $var;
                }
            }
        }
        return $result;
    }
}