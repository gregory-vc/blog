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

    static public function find($id, $key = false)
    {
        $model = new static;
        if (!$key) {
            $key = $model->key;
        }
        $result = $model->execute('SELECT * FROM '.$model->table.' WHERE '.$key.' = ?', [$id]);
        return $result;
    }

    static public function findBy($data)
    {
        $model = new static;
        $sql = 'SELECT * FROM '.$model->table.' WHERE ';
        $values = [];
        foreach ($data as $key => $value) {
            $sql .= $key.' = ? AND ';
            $values[] = $value;
        }
        $sql = trim($sql, ' AND ');
        $result = $model->execute($sql, $values);
        return $result;
    }

    static public function save($data)
    {
        try {
            $model = new static;
            $attributes = array_flip($model->attributes);
            $data = array_filter($data, function ($data) use ($attributes) {
                return isset($attributes[$data]);
            }, ARRAY_FILTER_USE_KEY);
            $sql = 'UPDATE '.$model->table.' SET ';
            if (empty($data[$model->key])) {
                throw new \Exception('Not found primary key');
            }
            $primary_key = $data[$model->key];
            unset($data[$model->key]);
            foreach ($data as $key => $value) {
                $sql .= ''.$key.' = :'.$key.', ';
            }
            $sql = trim($sql, ', ');
            $sql .= ' WHERE '.$model->key.' = :'.$model->key;
            $statement = $model->connect->prepare($sql);
            foreach ($data as $column => $value) {
                $statement->bindValue(':'.$column, $value);
            }
            $statement->bindValue(':'.$model->key, $primary_key);
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
