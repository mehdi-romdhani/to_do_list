let formulaireTask = document.querySelector("#task-form");
formulaireTask.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData(formulaireTask);
  console.log("toto");
  fetch("todolist.php", {
    method: "POST",
    body: data,
  })
    .then((response) => {
      return response.text();
    })
    .then((text) => {
      let taskDone = document.querySelector("#task_done");
      taskDone.innerHTML = text;

        fetch('todolist.php?getTask=all')
           
        .then((response)=>{
            console.log('test');
            return response.json();
        })
        .then((response)=>{
            let display = document.querySelector('#json_fetch');
            // display.innerHTML= response;


    
        
    });
});
});
   // Boucle forEach pour chaque objet JSON
// myJsonFile.forEach(function(item) {
//   // Boucle forEach pour chaque propriété de chaque objet JSON
//   Object.keys(item).forEach(function(key) {
//     console.log(key + ": " + item[key]);
//   });
// });response.forEach(item => {
    //   items += '<li>' + item.name + '</li>';
    // });

    // container.innerHTML = '<ul>' + items + '</ul>';
    //     })
        