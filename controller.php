<?php
require_once 'class/task.class.php';

$action = $_POST["action"];
$task = new task();


switch ($action) {
    case 'summary':
        echo $task->summary();
        break;
    case 'save':
        if (!$_POST["taskname"]){
            echo "Empty task name";
        } else {
            echo $task->create($_POST["taskname"], $_POST["time"]);
        }
        break;
    default:
        break;
}









