<?php

namespace My\Engine;

class Model {

    public $connect;

    public function __construct()
    {
        $connect = getenv('PDO_CONNECT');
        $user = getenv('PDO_USER');
        $password = getenv('PDO_PASSWORD');
        $this->connect = new \PDO($connect, $user, $password);
        $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connect->exec("SET CHARACTER SET utf8");
    }

    static public function all()
    {
        $model = new static;
        $result = $model->execute('SELECT * FROM '.$model->table);
        return $result;
    }

    static public function find($id)
    {
        $model = new static;
        $result = $model->execute('SELECT * FROM '.$model->table.' WHERE '.$model->key.' = ?', [$id]);
        if (is_array($result)) {
            $result = current($result);
        }
        return $result;
    }

    static public function add($data)
    {
        try {
            $model = new static;
            $attributes = array_flip($model->attributes);
            $data = array_filter($data, function ($data) use ($attributes) {
                return isset($attributes[$data]);
            }, ARRAY_FILTER_USE_KEY);
            $sql = 'INSERT INTO '.$model->table.' (';
            foreach ($data as $column => $value) {
                $sql .= '`'.$column.'`, ';
            }
            $sql = trim($sql, ', ');
            $sql .= ') VALUES (';
            foreach ($data as $column => $value) {
                $sql .= ':'.$column.', ';
            }
            $sql = trim($sql, ', ');
            $sql .= ')';
            $statement = $model->connect->prepare($sql);
            foreach ($data as $column => $value) {
                $statement->bindValue(':'.$column, $value);
            }
            try {
                $statement->execute();
                return $model->connect->lastInsertId();
            } catch(PDOExecption $e) {
                $model->connect->rollback();
                return "Error" . $e->getMessage();
            }
        } catch( PDOExecption $e ) {
            return "Error" . $e->getMessage();
        }
    }

    public function execute($sql, $params = []) {
        $attributes = array_flip($this->attributes);
        $result = [];
        $statement = $this->connect->prepare($sql);
        $statement->execute($params);
        foreach($statement as $row) {
            $result[] = array_filter($row, function ($data) use ($attributes) {
                return isset($attributes[$data]);
            }, ARRAY_FILTER_USE_KEY);
        }
        return $result;
    }
}
