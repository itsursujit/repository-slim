<?php

namespace Main;

use App\Exceptions\CriticalException;
use App\Helpers\ConfigHelper;

/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 1:51 PM
 */
class MySQLPersistent implements Persistent
{
    public $connection;
    public function __construct()
    {
	    $dbConfig = ConfigHelper::get('driver.mysql');
	    $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['db'] . ';charset=utf8';
	    $this->connection = new \Slim\PDO\Database($dsn, $dbConfig['user'], $dbConfig['pass']);
    	try {
		    $this->connection = new \Slim\PDO\Database($dsn, $dbConfig['user'], $dbConfig['pass']);
	    } catch ( \PDOException $exception) {
    		throw new CriticalException("Database not found");
	    }



    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
    }

    public function first()
    {
        // TODO: Implement first() method.
    }
}