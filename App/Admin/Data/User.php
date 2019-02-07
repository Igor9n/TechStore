<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 07.02.19
 * Time: 11:10
 */

namespace App\Admin\Data;


class User
{
    public $id;
    public $login;
    public $email;
    public $personalList;

    protected function __construct($id, string $login, string $email, array $personalList)
    {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->personalList = $personalList;
    }

    public static function getObject($id, string $login, string $email, array $personalList)
    {
        return new self($id, $login, $email, $personalList);
    }
}
