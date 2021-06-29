<?php

namespace DataHandle\Utils;

use DateTime;

function get_tasks($tasks)
{
    $html = "<div class='task-container'>";

    foreach ($tasks as $task) {
        $html .= "<div class='task-box'><div class='row'>";
        
        if($task['status']==1){
            $html .= "<div class='col'><label class='completed'>".$task['description']."</label></div>";
            $html .= "<div class='col icon'><a class='completa' href='/todo/includes/completa-todo.php?id=".$task['id']."&newStatus=0'><i class='far fa-check-square'></i></i></a>";
            $html .= "<a class='delete' href='/todo/includes/cancella-todo.php?id=".$task['id']."'><i class='fas fa-trash-alt'></i></a></div></div>";
        }else{ 
            $html .= "<div class='col'><label>".$task['description']."</label></div>";
            $html .= "<div class='col icon'><a class='completa' href='/todo/includes/completa-todo.php?id=".$task['id']."&newStatus=1'><i class='far fa-square'></i></i></a>";
            $html .= "<a class='delete' href='/todo/includes/cancella-todo.php?id=".$task['id']."'><i class='fas fa-trash-alt'></i></a></div></div>";
        }   
        $html .= "<div class='col'><label class='creation_date'>Created on ".date('d/m/Y',strtotime($task['date']))."</label></div></div>";  
    

    }
    $html .= "</div><a href='/todo/index.php?edit=1' class='btn btn-dark all-todo' >Edit all tasks<i class='fas fa-pencil-alt'></i></a>";
    $html .= "<a href='/todo/includes/cancella-todo.php' class='btn btn-dark all-todo'>Delete all tasks<i class='fas fa-trash-alt'></i></a>";

    return $html;

}

    function get_editable_tasks($tasks)
{
    $html = '';
    foreach ($tasks as $task) {
        $html .= "<div class='row'>";
        $html .= "<div class='col'><input id='".$task['id']."' name='task[]' class='form-control aggiorna' value='".$task['description']."' autocomplete='off'/></div></div>";;
        $html .= "<input hidden id='".$task['id']."' name='id[]'  value=".$task['id']." />";

    }
       

    $html .= "<button type='submit' class='btn btn-dark all-todo'>OK <i class='fas fa-pencil-alt'></i></button> ";
    $html .= "<a href='/todo/index.php' class='btn btn-dark all-todo'>Cancel <i class='fas fa-undo'></i></a>";
    
    return $html;
}
