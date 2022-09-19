<?php
error_reporting(E_ERROR | E_PARSE);
include('./config/config.php');

class MySqlConnector
{

    protected $config = array();
    protected $connectLink;
    protected $result;

    public function __construct(array $config)
    {

        if (count($config) !== 4) {
            throw new InvalidArgumentException('Invalid number of connection parameters..');
        }
        $this->config = $config;
    }

    public function connectDB()
    {
        if ($this->connectLink === null) {

            list($host, $user, $password, $database) = $this->config;

            $this->connectLink = @mysqli_connect($host, $user, $password, $database);
            if (!$this->connectLink) {
                throw new RuntimeException('Error happening when connecting to the server !!' . mysqli_connect_errno());
                unset($host, $user, $password, $database);
            }

            return $this->connectLink;
        }
    }

    public function setQuery($query)
    {
        if (!is_string($query) || empty($query)) {
            throw new InvalidArgumentException('The specified query is not valid..');
        }
        //excute lazy connect to mysql
        $this->connectDB();
        $this->result = mysqli_query($this->connectLink, $query);
        if (!$this->result) {
            throw new RuntimeException('Error excuting the specified query ' . $query . mysqli_errno($this->connectLink));
        }

        return $this->result;
    }

    public function selcetAllUsers($tableName, $where = '', $fields = "*", $order = '', $limit = null, $offest = null)
    {
        $selectQuery = 'SELECT' . $fields . 'FROM' . $tableName
            . (($where) ? ' WHERE ' . $where : '')
            . (($limit) ? ' LIMIT ' . $limit : '')
            . (($offest && $limit) ? ' OFFEST ' . $offest : '')
            . (($order) ? ' ORDER BY ' . $order : '');

        $this->setQuery($selectQuery);
        return $this->countOfRows();
    }

    public function insertNewUser($tableName, array $data)
    {
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_map(array($this, 'validateValues'), array_values($data)));
        $query = 'INSERT INTO ' . $tableName . ' (' . $fields . ') ' . ' (' . $values . ') ';
        $this->setQuery($query);
        return $this->getUserInsertedId();
    }

    public function currentUser($tableName, array $data, $where = '')
    {
        $setInfo = array();
        foreach ($$data as $key => $value) {
            $setInfo[] = $key . '=' . $this->validateValues($value);
        }
        $setInfo = implode(',', $setInfo);
        $query = 'UPDATE' . $tableName . ' SET ' .
            (($where) ? ' WHERE ' . $where : '');

        $this->setQuery($query);
        return $this->getUpdatedRows();
    }

    public function deleteSelectedUser($tableName, $where = '')
    {
        $query = 'DELETE FROM ' . $tableName .
            (($where) ? ' WHERE ' . $where : '');
        $this->setQuery($query);
        return $this->getUpdatedRows();
    }

    public function fetchUser()
    {
        if ($this->result !== null) {
            if ($row = mysqli_fetch_array($this->result, MYSQLI_ASSOC) === false) {
                $this->freeResult();
            }
            return $row;
        }
        return false;
    }
    public function fetchAllUsers()
    {
        if ($this->result !== null) {
            if ($allRows = mysqli_fetch_all($this->result, MYSQLI_ASSOC) === false) {
                $this->freeResult();
            }
            return $allRows;
        }
        return false;
    }
    public function getUpdatedRows()
    {
        return $this->connectLink !== null ? mysqli_affected_rows($this->connectLink) : 0;
    }

    private function countOfRows()
    {
        return $this->result !== null ? mysqli_num_rows($this->result) : 0;
    }
    public function getUserInsertedId()
    {
        return $this->connectLink !== null ? mysqli_insert_id($this->connectLink) : null;
    }

    public function validateValues($value)
    {
        $this->connectDB();
        if ($value === null) {
            $value = 'NULL';
        } else if (!is_numeric($value)) {
            $value = "'" . mysqli_real_escape_string($this->connectLink, $value) . "'";
        }
        return $value;
    }

    public function freeResult()
    {
        if ($this->connectLink === null) {
            return false;
        }

        mysqli_close($this->connectLink);
        $this->connectLink = null;
        return true;
    }

    public function disconnect()
    {
        if ($this->connectLink == null) {
            return false;
        }
        mysqli_close($this->connectLink);
        $this->connectLink = null;

        return true;
    }

    public function __destruct()
    {
        $this->disconnect();
    }
}