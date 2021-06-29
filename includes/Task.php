<?php

namespace DataHandle;

use mysqli;

class Task
{
    public static function addTask($task)
    {
        $task = $task['task'];

        $mysqli = new mysqli('localhost', 'root', '', 'todo');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

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
        $mysqli = new mysqli('localhost', 'root', '', 'todo');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }


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

        $mysqli = new mysqli('localhost', 'root', '', 'todo');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

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

    public static function completeTask($id)
    {
        $id = intval($id);

        $mysqli = new mysqli('localhost', 'root', '', 'todo');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }


        $query = $mysqli->prepare('UPDATE task SET status = 1 WHERE id = ?');
        $query->bind_param('i', $id);
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


        $mysqli = new mysqli('localhost', 'root', '', 'todo');

        if ($mysqli->connect_errno) {
            echo 'Connessione al database fallita: ' . $mysqli->connect_error;
            exit();
        }

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
