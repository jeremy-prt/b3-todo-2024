// Fonction JavaScript pour gérer le drag and drop
function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("task_id", event.target.id); // Stocker l'ID de la tâche
}

function drop(event, status) {
  event.preventDefault();
  var taskId = event.dataTransfer.getData("task_id");

  // Envoyer une requête POST pour mettre à jour le statut
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Recharger la page pour voir la tâche dans la nouvelle colonne
      location.reload();
    }
  };
  xhr.send("task_id=" + taskId + "&status=" + status);
}
