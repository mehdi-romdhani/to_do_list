let formulaireTask = document.querySelector("#task-form");
let ul_todo = document.querySelector("#ul_task_booked");
let ul_done = document.querySelector("#ul_task_finish");

// Ajoute un écouteur d'événement "submit" sur le formulaire de tâches
formulaireTask.addEventListener("submit", (e) => {
  //On stope le compporte par default du l'evenement du formulaire
  e.preventDefault();
  // Récupère les données du formulaire
  let data = new FormData(formulaireTask);
  console.log("toto");

  // Envoie une requête fetch avec les données du formulaire à todolist.php
  fetch("todolist.php", {
    method: "POST",
    body: data,
  })
    .then((response) => {
      return response.json();
    })
    .then((task) => {
      // Affiche la nouvelle tâche dans la liste
      displayOneTask(task, ul_todo);

      // Met à jour le message "Bien ajouté"
      let taskDone = document.querySelector("#task_done");
      taskDone.innerHTML = "Bien ajouté";
    });
});



function displayAllTask() {
  // Envoie une requête fetch à todolist.php pour récupérer toutes les tâches
  fetch("todolist.php?getTask=all")
    .then((response) => {
      console.log("coco");
      return response.json();
    })
    .then((tache) => {
      console.log(tache);

      // Affiche chaque tâche dans la liste
      for (let task of tache) {
        console.log(task.status);
        if (task.status == 1) {
          displayOneTask(task, ul_done);
        } else {
          displayOneTask(task, ul_todo);
        }
        //console.log(task);
      }
    });
}
// Affiche toutes les tâches enregistrées dans la base de données
displayAllTask();

function displayOneTask(dataTask, parent) {
  // Crée un nouvel élément de liste pour la tâche

  let newTaskList = document.createElement("li");
  newTaskList.setAttribute("class", "newTaskList");
  newTaskList.setAttribute("id", dataTask.id);

  newTaskList.textContent =
    dataTask.login +
    " Tache : " +
    dataTask.task +
    " : " +
    dataTask.date +
    " : " +
    dataTask.id +
    ":" +
    dataTask.status;
  // Crée un bouton à cocher pour la tâche
  let checkBox = document.createElement("button");
  checkBox.setAttribute("id", dataTask.id);
  if (parent.id === "ul_task_booked") {
    checkBox.setAttribute("class", "check-done");
    checkBox.textContent = "terminer";
    newTaskList.append(checkBox);
  } else {
    checkBox.setAttribute("class", "check-cancel");
    checkBox.textContent = "annuler tâche";
    let btn_delete = document.createElement("button");
    btn_delete.setAttribute("id", dataTask.id);
    btn_delete.setAttribute("class", "btn_delete_task");
    btn_delete.textContent = "supprimer";
    newTaskList.append(checkBox);
    newTaskList.append(btn_delete);
  }
  //console.log(checkBox);

  // Ajoute l'élément de liste et le bouton à cocher à la liste parent
  parent.appendChild(newTaskList);

  //On console chaque liste
  console.log(newTaskList);
  //On récupere l'élément avec la class du Btn
  let checkDone = document.querySelectorAll(".check-done");
  console.log(checkDone);
  let checkId;
  //Boucle for of pour attribuer chaque ID à chaque bouton
  for (let check of checkDone) {
    console.log(check);

    checkId = check.id;

    console.log(checkId); //est l'ID attribuer à chaque button .
    displayTaskDone(checkId);
  }
}
//displayTaskDone(dataTask.id);

function displayTaskDone(id) {
  // Sélectionne tous les boutons à cocher et ajoute un écouteur d'événement "click" à chacun d'entre eux
  let checkDone = document.querySelectorAll(".check-done");
  checkDone.forEach((check) => {
    // Vérifie si le bouton a l'ID correspondant et ajoute un écouteur d'événement "click" si c'est le cas
    if (check.id === id) {
      check.addEventListener("click", (e) => {
        if (check.textContent == "terminer") {
          // Obtient l'élément li de la ligne de la liste de tâches qui a été cochée
          let task = e.target.parentNode;

          // Crée une nouvelle instance de FormData pour envoyer l'ID de la tâche à todolist.php
          let idFormData = new FormData();
          idFormData.append("id_task", id);

          // Envoie une requête fetch à todolist.php pour marquer la tâche comme "terminée"
          fetch("todolist.php?doneTask=Id", {
            method: "POST",
            body: idFormData,
          })
            .then((response) => {
              console.log(response + "reponse btn");
              return response.json();
            })
            .then((donetask) => {
              console.log(donetask);

              // Ajoute la ligne de la liste de tâches cochée à la liste de tâches terminées
              if (donetask == "donee") {
                // Modifie le texte du bouton "check-done" en "annuler tâche"
                e.target.textContent = "annuler tâche";
                e.target.setAttribute("class", "check-cancel");
                console.log(e.target.setAttribute("class", "check-cancel"));

                // Crée un bouton pour supprimer la tâche
                let btn_delete = document.createElement("button");
                btn_delete.setAttribute("id", id);
                btn_delete.setAttribute("class", "btn_delete_task");
                btn_delete.textContent = "supprimer";

                // Ajoute le bouton de suppression et enlève le bouton "terminer" de la ligne de la liste de tâches
                task.appendChild(btn_delete);

                //task.removeChild(e.target);

                // Ajoute la ligne de la liste de tâches à la liste de tâches terminées
                ul_done.appendChild(task);
              }
            });
        } else {
          alert("set cancel");
        }
      });
    }
  });
}

ul_done.addEventListener("click", (e) => {
  // e.preventDefault()
  if (e.target.classList.contains("btn_delete_task")) {
    console.log("click");
    deleteTask(e.target.getAttribute("id"));
  }
});

function deleteTask(id) {
  console.log(id);
}
