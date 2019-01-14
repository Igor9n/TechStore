<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.01.19
 * Time: 19:46
 */

namespace App\Core;


use App\Classes\DBConnection;

class Model
{
    public $pdo;

    public function __construct() {
        $this->pdo = DBConnection::getInstance();
    }

    protected function queryOne($query, $value, $column) {
        $query = $this->pdo->prepare($query);
        $query->execute(['value' => $value]);
        return $query->fetchColumn($column);
    }

    protected function selectCondition($query, $value) {
        if (gettype($value) === 'integer') {
            $condition = 'id';
        } else {
            $condition = 'service_title';
        }
        $query = sprintf($query,$condition);
        return $query;
    }

    protected function selectTypeAndQuery($query, $value, $column) {
        $query = $this->selectCondition($query, $value);
        return $this->queryOne($query, $value, $column);
    }

    protected function queryList($query, $column, array $variables = []) {
        $query = $this->pdo->prepare($query);
        $query->execute($variables);
        if ($column === 0) {
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