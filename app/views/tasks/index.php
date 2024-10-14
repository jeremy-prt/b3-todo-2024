<?php
require_once '../../../app/controllers/TaskController.php';

$taskController = new TaskController();
$tasks = $taskController->getTasks();
$todoCount = 0;
$inProgressCount = 0;
$doneCount = 0;

// Boucle pour compter les tâches par statut
foreach ($tasks as $task) {
    if ($task['status'] == 'todo') {
        $todoCount++;
    } elseif ($task['status'] == 'in_progress') {
        $inProgressCount++;
    } elseif ($task['status'] == 'done') {
        $doneCount++;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $taskController->updateTaskStatus($_POST['task_id'], $_POST['status']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de tâches</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <h1>Gestionnaire de tâches</h1>
    <div class="kanban-board">
        <!-- Colonne "À faire" avec compteur -->
        <div class="kanban-column" ondrop="drop(event, 'todo')" ondragover="allowDrop(event)">
            <h2>À faire | <?php echo $todoCount; ?></h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'todo'): ?>
                    <div class="task todo" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                    <div class="task-header">
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <div class="icons">
                                <a href="edit.php?id=<?php echo $task['id']; ?>" class="edit-button">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                    </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création : <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance : <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Colonne "En cours" avec compteur -->
        <div class="kanban-column" ondrop="drop(event, 'in_progress')" ondragover="allowDrop(event)">
            <h2>En cours | <?php echo $inProgressCount; ?></h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'in_progress'): ?>
                    <div class="task in-progress" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                    <div class="task-header">
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <div class="icons">
                                <a href="edit.php?id=<?php echo $task['id']; ?>" class="edit-button">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                    </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création: <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Colonne "Terminé" avec compteur -->
        <div class="kanban-column" ondrop="drop(event, 'done')" ondragover="allowDrop(event)">
            <h2>Terminé | <?php echo $doneCount; ?></h2>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task['status'] == 'done'): ?>
                    <div class="task done" id="<?php echo $task['id']; ?>" draggable="true" ondragstart="drag(event)">
                    <div class="task-header">
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                            <div class="icons">
                                <a href="edit.php?id=<?php echo $task['id']; ?>" class="edit-button">
                                    <i class="fas fa-pen-to-square"></i>
                                </a>
                                <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                    </div>
                        <p><?php echo htmlspecialchars($task['description']); ?></p>
                        <p>Date de création: <?php echo htmlspecialchars($task['created_at']); ?></p>
                        <p>Date d'échéance: <?php echo htmlspecialchars($task['due_date']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <a id="add-task" href="add.php">
        <button>Ajouter une tâche</button>
    </a>
    <script src="../../../public/js/script.js"></script>
</body>
</html>
