<?php

namespace DataHandle;

require_once __DIR__.'/db.php';


class Task
{
    public static function addTask($task)
    {
        $task = $task['task'];

        global $mysqli;
        $query = $mysqli->prepare('INSERT INTO task(description) VALUES (?)');
        $query->bind_param('s', $task);
        $query->execute();

        if ($query->affected_rows === 0) {

            header('Location: https://localhost/todo/index.php?stato=ko');
            exit;
        }

        header('Location: https://localhost/todo/index.php?stato=ok');
        exit;
    }

    public static function selectData()
    {
        global $mysqli;
        $query = $mysqli->query('SELECT description,id,status,date FROM task');


        $results = array();

        while ($row = $query->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

    public static function updateTask($values)
    {
        $task = $values['task'];
        $id = $values['id'];

        global $mysqli;

        for ($i = 0; $i < count($task); $i++) {
            $query = $mysqli->prepare('UPDATE task SET description = ? WHERE id = ?');
            $query->bind_param('si', $task[$i], intval($id[$i]));
            $query->execute();
            $results[$i] = $query->affected_rows;
        }


        if (!$results) {
            header('Location: https://localhost/todo/index.php?stato=ko');
            exit;
        }

        header('Location: https://localhost/todo/index.php?stato=ok');
        exit;
    }

    public static function changeTaskStatus($id, $status)
    {
        $id = intval($id);
        $status = intval($status);

        global $mysqli;


        $query = $mysqli->prepare('UPDATE task SET status = ? WHERE id = ?');
        $query->bind_param('ii', $status,$id);
        $query->execute();


        if ($query->affected_rows === 0) {
            header('Location: https://localhost/todo/index.php?stato=ko');
            exit;
        }

        header('Location: https://localhost/todo/index.php?stato=ok');
        exit;
    }



    public static function deleteTask($id = null)
    {
        global $mysqli;

        if (isset($id)) {
            $id = intval($id);
            $query = $mysqli->prepare('DELETE FROM task WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();

            if ($query->affected_rows === 0) {

                header('Location: https://localhost/todo/index.php?statocanc=ko');
                exit;
            }

            header('Location: https://localhost/todo/index.php?statocanc=ok');
            exit;
        } else {
            $query = $mysqli->query('DELETE FROM task');


            if ($query->affected_rows === 0) {

                header('Location: https://localhost/todo/index.php?statocanc=ko');
                exit;
            }

            header('Location: https://localhost/todo/index.php?statocanc=ok');
            exit;
        }
    }
}
