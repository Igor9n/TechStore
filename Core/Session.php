<?php

namespace Core;

class Session
{
    private const PATH = '../storage/sessions';
    private const NAME = 'USID';

    /**
     * @return bool
     */
    public static function start(): bool
    {
        if (self::cookieExists()) {
            return self::sessionStart();
        }
        return false;
    }

    /**
     * Session start
     *
     * @return bool
     */
    public static function sessionStart(): bool
    {
        session_save_path(self::PATH);
        session_name(self::NAME);
        return session_start();
    }

    /**
     * @return bool
     */
    public static function cookieExists(): bool
    {
        if (isset($_COOKIE[self::NAME])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function sessionExists(): bool
    {
        if (!session_id()) {
            return false;
        }
        return true;
    }

    /**
     * @param $title
     * @param $value
     * @return bool
     */
    public static function set($title, $value = null): bool
    {
        if (!self::sessionExists()) {
            self::sessionStart();
        }

        if (is_array($title)) {
            foreach ($title as $key => $value) {
                self::set($key, $value);
            }
        } else {
            $_SESSION[$title] = $value;
        }
        return true;
    }

    private static function unsetFirst($title)
    {
        if (self::check($title)) {
            unset($_SESSION[$title]);
        }
        return true;
    }

    private static function unsetSecond($info)
    {
        $first = $info[0];
        $second = $info[1];
        if (is_object($_SESSION[$first])) {
            unset($_SESSION[$first]->$second);
        } else {
            unset($_SESSION[$first][$second]);
        }
        return true;
    }

    private static function unsetThird($info)
    {
        $first = $info[0];
        $second = $info[1];
        $third = $info[2];

        if (is_object($_SESSION[$first])) {
            if (is_object($_SESSION[$first]->$second)) {
                unset($_SESSION[$first]->$second->$third);
            } else {
                unset($_SESSION[$first]->$second[$third]);
            }
        } else {
            if (is_object($_SESSION[$first][$second])) {
                unset($_SESSION[$first][$second]->$third);
            } else {
                unset($_SESSION[$first][$second][$third]);
            }
        }

        return true;
    }

    /**
     * @param $variables mixed
     * @return bool|string
     */
    public static function unset($variables)
    {
        $result = 'Invalid data';

        if (is_array($variables)) {
            foreach ($variables as $variable) {
                self::unset($variable);
            }
        } else {
            $info = explode('.', $variables);
            $count = count($info);
            if ($count === 1) {
                $result = self::unsetFirst($info[0]);
            } elseif ($count === 2) {
                $result = self::unsetSecond($info);
            } elseif ($count === 3) {
                $result = self::unsetThird($info);
            }
        }
        return $result;
    }

    /**
     * @param $title
     * @return null
     */
    public static function get($title)
    {
        $result = null;
        if (self::check($title)) {
            $result = $_SESSION[$title];
        }
        return $result;
    }

    /**
     * @param $title
     * @return bool
     */
    public static function check($title)
    {
        $result = false;
        if (isset($_SESSION[$title])) {
            $result = true;
        }
        return $result;
    }
}
