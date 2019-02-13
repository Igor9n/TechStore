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

    /**
     * @param $query
     * @param array $value
     * @param null $column
     * @return bool
     */
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

    /**
     * @param $query
     * @param array $values
     * @return mixed
     */
    protected function queryRow($query, array $values = [])
    {
        $query = $this->pdo->prepare($query);
        $query->execute($values);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    protected function selectCondition($query, $value)
    {
        if (preg_match('/^[0-9]+$/', $value)) {
            $condition = 'id';
        } else {
            $condition = 'service_title';
        }
        return sprintf($query, $condition);
    }

    /**
     * @param $query
     * @param $value
     * @param $flag
     * @param int $column
     * @return bool|mixed
     */
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

    /**
     * @param $query
     * @param $column
     * @param array $variables
     * @return array
     */
    protected function queryList($query, $column, array $variables = []): array
    {
        $array = [];
        $query = $this->pdo->prepare($query);
        $query->execute($variables);

        while ($value = $query->fetch(PDO::FETCH_ASSOC)) {
            $array[] = $value[$column];
        }
        return $array;
    }

    /**
     * @param $query
     * @param array $variables
     * @return array
     */
    protected function queryArray($query, $variables = []): array
    {
        $query = $this->pdo->prepare($query);
        $query->execute($variables);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $arrayOne
     * @param $arrayTwo
     * @return array
     */
    protected function matchData($arrayOne, $arrayTwo): array
    {
        $result = [];
        for ($i = 0; $i < count($arrayOne); $i++) {
            $result[$arrayOne[$i]] = $arrayTwo[$i];
        }
        return $result;
    }
}