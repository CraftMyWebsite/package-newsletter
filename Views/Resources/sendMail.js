document.getElementById("sendMail").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupérez l'adresse e-mail du formulaire
    const newsletter_object = document.getElementById("newsletter_object").value;
    const newsletter_content = tinymce.activeEditor.getContent();
    const button = document.getElementById("sendButton");
    button.disabled = true;
    button.innerHTML = 'Envoie en cours <i class="fa-solid fa-spinner fa-spin"></i>';

    // Créez une instance de XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Configurez la requête
    xhr.open("POST", "/cmw-admin/newsletter/manage", true);


    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                iziToast.show(
                    {
                        titleSize: '16',
                        messageSize: '14',
                        icon: 'fa-solid fa-check',
                        title: "Newsletter",
                        message: response.message,
                        color: "#41435F",
                        iconColor: '#22E445',
                        titleColor: '#22E445',
                        messageColor: '#fff',
                        balloon: false,
                        close: false,
                        position: 'bottomRight',
                        timeout: 5000,
                        animateInside: false,
                        progressBar: false,
                        transitionIn: 'fadeInLeft',
                        transitionOut: 'fadeOutRight',
                    });
                button.innerHTML = 'Newsletter envoyé ! <i class="fa-solid fa-check"></i>';
            } else {
                iziToast.show(
                    {
                        titleSize: '16',
                        messageSize: '14',
                        icon: 'fa-solid fa-xmark',
                        title  : "Mail",
                        message: response.message,
                        color: "#41435F",
                        iconColor: '#DE2B59',
                        titleColor: '#DE2B59',
                        messageColor: '#fff',
                        balloon: false,
                        close: false,
                        position: 'bottomRight',
                        timeout: 5000,
                        animateInside: false,
                        progressBar: false,
                        transitionIn: 'fadeInLeft',
                        transitionOut: 'fadeOutRight',
                    });
            }
        }
    };

    // Configurez le gestionnaire d'événements pour les erreurs
    xhr.onerror = function() {
        console.error("Erreur de réseau lors de la requête.");
    };

    // Préparez les données à envoyer
    const data = "newsletter_object=" + newsletter_object + "&newsletter_content=" + newsletter_content;

    // Définissez les en-têtes pour la requête POST
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Envoyez la requête avec les données
    xhr.send(data);
});