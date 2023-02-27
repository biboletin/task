<?php

/**
 * Description of PDOConnection
 *
 * @author BK
 */
class PDOConnection implements SQLQuery
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
     *
     * @return object
     */
    public function getConnection()
    {
        $dsn = 'mysql:host=' . DB_HOST_ADDRESS . ';';
        $dsn .= 'port=' . DB_PORT . ';';
        $dsn .= 'dbname=' . DB_DATABASE_NAME;

        try {
            self::$connection = new PDO(
                $dsn,
                DB_USER,
                DB_PASSWORD
            );
        } catch (PDOException $error) {
            die('Грешка: ' . $error->getMessage());
        }

        self::$connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        self::$connection->exec('SET NAMES ' . DATABASE_CHARSET);
        return self::$connection;
    }

    /**
     * Изпълнява SQL заявка
     * Връща true или false при UPDATE и INSERT заявка
     *
     * Връща масив с данни при SELECT заявка
     *
     * @param string $sql SQL заявка
     * @return mixed
     */
    public function sqlQuery($sql = '')
    {
        if (($sql === null) || ($sql === '')) {
            die('Празна заявка!');
        }

        $queryType = explode(' ', strtolower(trim($sql)));
        $action = $queryType[0];

        if ($action !== 'select') {
            return (bool) self::$connection->query($sql);
        }
        $result = self::$connection->query($sql, PDO::FETCH_ASSOC);
        $data = [];
        while ($row = $result->fetchAll()) {
            $data[] = $row;
        }
        unset($row);
        return array_shift($data);
    }

    public function lastId()
    {
        return self::$connection->lastInsertId();
    }
}
