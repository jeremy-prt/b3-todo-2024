<?php
require_once '../../../app/controllers/TaskController.php';

if (isset($_GET['id'])) {
    $taskController = new TaskController();
    $taskController->deleteTask($_GET['id']);
    
    header('Location: index.php');
    exit;
}
?>
