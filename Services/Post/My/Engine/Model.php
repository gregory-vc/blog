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
    }

    static public function all()
    {
        $model = new static;
        $result = $model->execute('SELECT * from '.$model->table);
        return $result;
    }

    static public function find($id)
    {
        $model = new static;
        $result = $model->execute('SELECT * from '.$model->table.' where '.$model->key.' = ?', [$id]);
        if (is_array($result)) {
            $result = current($result);
        }
        return $result;
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
