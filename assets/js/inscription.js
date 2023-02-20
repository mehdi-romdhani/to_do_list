let btn_subscribe = document.querySelector("#btn-subscribe"); //Btn-inscription


//Inscription
btn_subscribe.addEventListener("click", () => {
  fetch("inscription.php")
    .then((response) => {
      //Formatage de la reponse sous format TXT
      return response.text();
    })
    .then((text) => {
      //Container pour les formulaires
      let containerForm = document.querySelector(".container-form");
      //Affichage du formulaire
      containerForm.innerHTML = text;
      //Container formulaires
      let formulaireInscription = document.querySelector("#form_subscribe");
      formulaireInscription.addEventListener("submit", (e) => {
        //Permet de stopper le comportement par default du formulaire
        e.preventDefault();
        console.log("toto");
        //Instance de la classe formData pour recuperer les data du Formulaire
        let dataFormulaire = new FormData(formulaireInscription); //
        // API FETCH POUR AVOIR UN COMPORTEMENT ASYNCHRONE
        fetch("inscription.php", {
          // Url Requete
          method: "POST",
          body: dataFormulaire,
        })
          .then((response) => {
            //Formatage de la reponse sous format text
            return response.text();
          })
          .then((textReponse) => {
            //Conditions suite à la reponse de la requette FETCH
            if (textReponse === "Inscription réussie") {
              //Balise <p> qui servira d'affichage pour la reponse
              let messForm = document.querySelector("#mess_done");
              //Si la condition est remplie , la propriéte display du formulaire sera changé
              let formulaireInscription=document.querySelector("#form_subscribe");
              formulaireInscription.style.display = "none";
              messForm.innerHTML = textReponse;
              console.log(textReponse);
            } else {
              //Si la condition ci-dessus n'est pas remplie, la réponse sera renvoié automatiquement 
              let messForm = document.querySelector("#mess_done");
              messForm.innerHTML = textReponse;
              console.log(textReponse);
            }
          });
      });
    });
});


