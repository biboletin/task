<?php

/**
 * Клас за свързване с база данни, чрез MySQLi
 *
 * @author BK
 */
class MySQLiConnection implements SQLQuery
{
    /**
     *
     * @var object
     */
    private static $instance;

    /**
     *
     * @var object
     */
    private static $connection;

    /**
     *
     */
    private function __construct()
    {
        // no construct
    }

    /**
     *
     */
    private function __clone()
    {
        // no cloning
    }

    /**
     * Създаване на нова инстанция
     *
     * @return object
     */
    public static function getInstance()
    {
        self::$instance = null;

        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Връзка с база данни
     *
     * @return object
     */
    public function getConnection()
    {
        if (!function_exists('mysqli_connect')) {
            die('Активирайте MySQLi разширението!');
        }
        self::$connection = new mysqli(DB_HOST_ADDRESS, DB_USER, DB_PASSWORD, DB_DATABASE_NAME, DB_PORT);
        if (mysqli_connect_error()) {
            error_log(mysqli_error(self::$connection));
            die('Грешка при връзката с базата данни!');
        }

        if (!mysqli_select_db(self::$connection, DB_DATABASE_NAME)) {
            error_log(mysqli_error(self::$connection));
            die('Грешка: Не е избрана база данни!');
        }
        self::$connection->query('SET CHARACTER SET ' . DATABASE_CHARSET);
        return self::$connection;
    }

    /**
     * Изпълнява SQL заявка
     * Връща true или false при UPDATE и INSERT заявка
     *
     * Връща масив с данни при SELECT заявка
     *
     * @param string $sql SQL заявка
     *
     * @return mixed
     */
    public function sqlQuery($sql = '')
    {
        if (($sql === null) || ($sql === '')) {
            die('Празна заявка!');
        }
        $action = explode(' ', strtolower(trim($sql)));
        $result = [];
        if ($action[0] !== 'select') {
            return (bool) self::$connection->query($sql);
        }
        if ($action[0] === 'select') {
            if (!self::$connection->query($sql)) {
                return $result;
            }

            $query = self::$connection->query($sql);

            while ($row = $query->fetch_assoc()) {
                $result[] = $row;
            }
            unset($row);
            $query->free();
            return $result;
        }
    }
    /**
     * Изпълнява няколко SQL заявки едновременно.
     *
     * @param string $sql SQL заявка
     */
    public function multi($sql = '')
    {
        return self::$connection->multi_query($sql);
    }

    public function lastId()
    {
        return self::$connection->insert_id;
    }
}
