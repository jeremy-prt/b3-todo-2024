<?php
require_once '../../../app/controllers/TaskController.php';

$taskController = new TaskController();

$tasks = $taskController->getTasks();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $taskController->updateTaskStatus($_POST['task_id'], $_POST['status']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <h1>Gestionnaire de tâches</h1>
    <div class="kanban-board">
        <!-- Colonne "À faire" -->
        <div class="kanban-column" ondrop="drop(event, 'todo')" ondragover="allowDrop(event)">
            <h2>À faire</h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'todo'): ?>
                    <div class="task" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                        <div class="task-header">
                            <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button">Supprimer</a>
                        </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création: <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Colonne "En cours" -->
        <div class="kanban-column" ondrop="drop(event, 'in_progress')" ondragover="allowDrop(event)">
            <h2>En cours</h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'in_progress'): ?>
                    <div class="task" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                        <div class="task-header">
                            <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</a>
                        </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création: <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Colonne "Terminé" -->
        <div class="kanban-column" ondrop="drop(event, 'done')" ondragover="allowDrop(event)">
            <h2>Terminé</h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'done'): ?>
                    <div class="task" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                        <div class="task-header">
                            <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</a>
                        </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création: <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <a href="add.php">Ajouter tâche</a>
    <script src="../../../public/js/script.js"></script>
</body>
</html>
