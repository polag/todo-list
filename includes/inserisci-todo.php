<?php
include_once __DIR__.'/Task.php';

$task = $_POST;
\DataHandle\Task::addTask($task);