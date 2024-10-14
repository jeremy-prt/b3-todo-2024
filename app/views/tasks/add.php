<?php
require_once '../../../app/controllers/TaskController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController = new TaskController();
    // Ajout de la nouvelle tâche via le contrôleur
    $taskController->addTask($_POST['title'], $_POST['description'], $_POST['status'], $_POST['due_date']);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter une nouvelle tâche</h1>
        <form action="add.php" method="POST">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>

            <label for="status">Statut :</label>
            <select id="status" name="status" required>
                <option value="todo">À faire</option>
                <option value="in_progress">En cours</option>
                <option value="done">Terminé</option>
            </select>

            <label for="due_date">Date d'échéance :</label>
            <input type="date" id="due_date" name="due_date" required>

            <button type="submit">Ajouter la tâche</button>
        </form>

        <a href="index.php">Retour à la liste des tâches</a>
    </div>
</body>
</html>
