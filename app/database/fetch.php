<?php

function all($table, $fields = '*')
{
    try {
        $connect = connect();
        $query = $connect->query("select {$fields} from {$table}");

        return $query->fetchAll();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

function findBy($table, $field, $value,$fields = '*')
{
    try {
        $connect = connect();

        $prepare = $connect->prepare("select {$fields} from {$table} where {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);
        return $prepare->fetchObject();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

function create($table, $value)
{

    try {
        $connect = connect();

        $sql = "insert into {$table} (";
        $sql .=  implode(',', array_keys($value)) . ") values (";
        $sql .= ':' . implode(',:', array_keys($value)) . ")";

        $prepare = $connect->prepare($sql);

        return $prepare->execute($value);
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}