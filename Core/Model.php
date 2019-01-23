<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.01.19
 * Time: 19:46
 */

namespace Core;


use App\Classes\DBConnection;
use PDO;

class Model
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DBConnection::getInstance();
    }


    protected function queryColumn($query, array $value = [], $column = null)
    {
        $query = $this->pdo->prepare($query);
        $query->execute($value);
        if ($column === null) {
            return true;
        } else {
            return $query->fetch()[$column];
        }
    }

    protected function queryRow($query, array $values = [])
    {
        $query = $this->pdo->prepare($query);
        $query->execute($values);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    protected function selectCondition($query, $value)
    {
        if (gettype($value) === 'integer') {
            $condition = 'id';
        } else {
            $condition = 'service_title';
        }
        $query = sprintf($query, $condition);
        return $query;
    }

    protected function selectTypeAndQuery($query, $value, $flag, $column = 0)
    {
        $query = $this->selectCondition($query, $value);

        switch ($flag) {
            case 'col':
                return $this->queryColumn($query, ['value' => $value], $column);
            case 'row':
                return $this->queryRow($query, ['value' => $value]);
        }
    }

    protected function queryList($query, $column, array $variables = [])
    {
        $array = [];
        $query = $this->pdo->prepare($query);
        $query->execute($variables);

        if ($column === 'id' || preg_match('/[a-z]_id$/', $column)) {
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