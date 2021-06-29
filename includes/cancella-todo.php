<?php
include_once __DIR__.'/Task.php';

if(isset($_GET['id'])){
    \DataHandle\Task::deleteTask($_GET['id']);
}else{
    \DataHandle\Task::deleteTask();
} 

