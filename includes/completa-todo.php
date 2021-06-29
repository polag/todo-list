<?php
include_once __DIR__.'/Task.php';

$id = $_GET['id'];
$status = $_GET['newStatus'];

\DataHandle\Task::changeTaskStatus($id,$status);
