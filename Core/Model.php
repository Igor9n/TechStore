<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.01.19
 * Time: 19:46
 */

namespace Core;


use App\Classes\DBConnection;

class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getInstance();
    }


    protected function queryOne($query, array $value, $column = null)
    {
        $query = $this->pdo->prepare($query);
        $query->execute($value);
        if ($column === null) {
            return true;
        } else {
            return $query->fetch()[$column];
        }
    }

    protected function selectCondition($query, $value)
    {
        if (gettype($value) === 'integer') {
            $condition = 'id';
        } else {
            $condition = 'service_title';
        }
        $query = sprintf($query,$condition);
        return $query;
    }

    protected function selectTypeAndQuery($query, $value, $column)
    {
        $query = $this->selectCondition($query, $value);
        return $this->queryOne($query, ['value' => $value], $column);
    }

    protected function queryList($query, $column, array $variables = [])
    {
        $array = [];
        $query = $this->pdo->prepare($query);
        $query->execute($variables);
        if ($column === 'id' || preg_match('/[a-z]_id$/',$column)) {
            while ($value = $query->fetch()) {
                $array[] = (int) $value[$column];
            }
        } else {
            while ($value = $query->fetch()) {
                $array[] = $value[$column];
            }
        }
        return $array;
    }
}