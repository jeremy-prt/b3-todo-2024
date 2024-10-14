<?php
require_once '../../../app/controllers/TaskController.php';

$taskController = new TaskController();

if (isset($_GET['id'])) {
    $tasks = $taskController->getTasks();
    
    foreach ($tasks as $task) {
        if ($task['id'] === $_GET['id']) {
            $currentTask = $task;
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->editTask($_POST['id'], $_POST['title'], $_POST['description'], $_POST['status'], $_POST['due_date']);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier une tâche</h1>

        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($currentTask['id']); ?>">

            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($currentTask['title']); ?>" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($currentTask['description']); ?></textarea>

            <label for="status">Statut :</label>
            <select id="status" name="status" required>
                <option value="todo" <?php echo $currentTask['status'] == 'todo' ? 'selected' : ''; ?>>À faire</option>
                <option value="in_progress" <?php echo $currentTask['status'] == 'in_progress' ? 'selected' : ''; ?>>En cours</option>
                <option value="done" <?php echo $currentTask['status'] == 'done' ? 'selected' : ''; ?>>Terminé</option>
            </select>

            <label for="due_date">Date d'échéance :</label>
            <input type="date" id="due_date" name="due_date" value="<?php echo htmlspecialchars($currentTask['due_date']); ?>" required>

            <button type="submit">Mettre à jour la tâche</button>
        </form>

        <a href="index.php">Retour à la liste des tâches</a>
    </div>
</body>
</html>
