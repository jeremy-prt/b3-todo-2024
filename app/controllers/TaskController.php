<?php

class TaskController
{
    private $tasksFile;

    public function __construct()
    {
        $this->tasksFile = realpath(__DIR__ . '/../../tasks.json') ?: __DIR__ . '/../../tasks.json';
    }

    public function getTasks()
    {
        if (file_exists($this->tasksFile)) {
            $tasks = json_decode(file_get_contents($this->tasksFile), true);
            return is_array($tasks) ? $tasks : [];
        } else {
            return [];
        }
    }

    public function addTask($title, $description, $status, $dueDate)
    {
        $tasks = $this->getTasks();
        $newTask = [
            'id' => uniqid(),
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'due_date' => $dueDate
        ];
        $tasks[] = $newTask;
        file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    public function updateTaskStatus($id, $status)
    {
        $tasks = $this->getTasks();
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['status'] = $status;
                break;
            }
        }
        file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    public function deleteTask($id)
    {
      $tasks = $this->getTasks();
      // Filtrer les tâches pour supprimer celle qui correspond à l'ID
      $tasks = array_filter($tasks, function($task) use ($id) {
          return $task['id'] !== $id;
      });

      // Réécrire le fichier JSON avec les tâches restantes
      file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    public function editTask($id, $title, $description, $status, $dueDate)
    {
        $tasks = $this->getTasks();

        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['title'] = $title;
                $task['description'] = $description;
                $task['status'] = $status;
                $task['due_date'] = $dueDate;
                break;
            }
        }

        file_put_contents($this->tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }


    
}
