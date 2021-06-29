<?php
include_once __DIR__.'/Task.php';

$id = $_GET['id'];

\DataHandle\Task::completeTask($id);