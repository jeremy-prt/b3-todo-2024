<?php
require_once '../../../app/controllers/TaskController.php';

$taskController = new TaskController();

$tasks = $taskController->getTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ma todo list</h1>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th>Date d'échéance</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="6">Aucune tâche disponible pour le moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($task['title']); ?></td>
                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                            <td><?php echo htmlspecialchars($task['status']); ?></td>
                            <td><?php echo htmlspecialchars($task['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                            <td>
                                <a href="#">Modifier</a> | 
                                <a href="#">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="add.php">
            <button>Ajouter une nouvelle tâche</button>
        </a>
    </div>
</body>
</html>
