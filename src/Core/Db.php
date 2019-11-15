<?php
/**
 * Created by PhpStorm.
 * User: ioan
 * Date: 26.11.16
 * Time: 18:49
 */

namespace App\Core;

//синглтон по работе с БД
class Db
{
    protected $dbh;
    protected static $connection;

    private function __construct()
    {
        $driver = 'mysql';
        $dbconf = include(__DIR__ . '/../../conf.php');

        $dsn = $driver . ':host=' . $dbconf['host'] . ';dbname=' . $dbconf['dbname'];
        try {
            $this->dbh = new \PDO($dsn, 'cn17628_translat', $dbconf['password'], [
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',]);
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->dbh->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
    }

    public static function getInstance()
    {
        if (static::$connection === null) {
            static::$connection = new static();
        }
        return static::$connection;
    }

    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);

        try {
            $result = $sth->execute($data);
        } catch (\PDOException $exception) {
            header('Location: /Action/NotFound');
            exit;
        }
        if (false === $result) {
            var_dump($sth->errorInfo());
            die;
        }
        return true;
    }

    /**
     * @param string $sql
     * @param array $data
     * @param null $class
     * @return object
     */
    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        try {
            $result = $sth->execute($data);
        } catch (\PDOException $exception) {
            header('Location: /Action/NotFound');
            exit;
        }
        if (false === $result) {
            var_dump($sth->errorInfo());
            die;
        }
        if (null === $class) {
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

}