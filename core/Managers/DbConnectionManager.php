<?php
/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/13/17
 * Time: 11:16 AM
 */

namespace Main\Managers;

use App\Exceptions\BaseTableNotFoundException;
use App\Exceptions\InvalidRepositoryToStringException;
use App\Repositories\Repository;
use Main\Helpers\Inflector;
use Slim\PDO\Database;

/**
 * Class DbConnectionManager
 * @package App\Managers
 */
class DbConnectionManager implements Repository
{

    protected $repository;

    protected $baseTable;
    /**
     * @var Database
     */
    protected $db;

    /**
     * DbConnectionManager constructor.
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        global $persistent;
        $this->db = $persistent->getConnection();


        $baseTable = $this->repository->__toString();
        $baseTable = $this->getBaseTable($baseTable);
        if(!empty($baseTable)) {
            $this->baseTable = $baseTable;
        }
    }

    public function all() {
        $this->tableGuard();

        $query = $this->db->select()->from($this->baseTable);
        $statement = $query->execute();
        $courses = $statement->fetchAll();
        return $courses;
    }

    public function query($sql) {

    }

    public function first() {

    }

    function findById($id)
    {
        $this->tableGuard();

        $query = $this->db->select()->from($this->baseTable)->where('id', '=', $id);
        $statement = $query->execute();
        $courses = $statement->fetch();
        return $courses;
    }

    function find()
    {
        // TODO: Implement find() method.
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function insert()
    {
        // TODO: Implement insert() method.
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }

    function getBuilder()
    {
        // TODO: Implement getBuilder() method.
    }

    function toString()
    {
        // TODO: Implement toString() method.
    }

    function tableGuard() {
        if(empty($this->baseTable)) {
            throw new BaseTableNotFoundException("BaseTable not defined in " . $this->repository);
        }
    }

    function getBaseTable($repositoryString)
    {
        if(empty($repositoryString)) {
            throw new InvalidRepositoryToStringException("Please return string in __toString for the repository");
        }

        $repoParts = explode('\\', $repositoryString);

        $baseTablePart = $repoParts[count($repoParts) - 1];
        if(!strpos($baseTablePart, 'Repository') === false) {
            $baseTable = strtolower(str_replace('Repository', '', $baseTablePart));
            $baseTable = Inflector::pluralize($baseTable);
        } else {
            $baseTable = $repositoryString;
        }

        return $baseTable;
    }

    function __toString()
    {
        return __CLASS__;
    }
}