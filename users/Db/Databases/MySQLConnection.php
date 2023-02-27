<?php

/**
 * Клас за свързване с база данни, чрез MySQL
 *
 * @author BK
 */
class MySQLConnection implements SQLQuery
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
     * @var string
     */
    public $encoding;
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

        if (self::$instance == null) {
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
        self::$connection = mysql_connect(
            DB_HOST_ADDRESS,
            DB_USER,
            DB_PASSWORD
        );
        if (!self::$connection) {
            die('Грешка: ' . mysql_error());
        }

        if (!mysql_select_db(DB_DATABASE_NAME)) {
            die('Грешка: ' . mysql_error());
        }
        if ($this->encoding !== '') {
            mysql_query(
                'SET CHARACTER SET ' . $this->encoding,
                self::$connection
            );
        }
        if ($this->encoding === '') {
            mysql_query(
                'SET CHARACTER SET ' . DATABASE_CHARSET,
                self::$connection
            );
        }
        return self::$connection;
    }

    public function lastId()
    {
        return (int) mysql_insert_id();
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
        if (($action === 'insert') || ($action === 'update')) {
            $this->logger->logit($sql);
            return (bool) mysql_query($sql);
        }

        $result = mysql_query($sql);
        $data = [];

        while ($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        mysql_free_result($result);
        unset($result);
        unset($row);
        mysql_close(self::$connection);
        return (array) $data;
    }

}
