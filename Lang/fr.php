<?php

return [
    "title" => "Newsletter",
    "description" => "Gérez vos newsletter",
    "unsubscribe" => "Ne plus recevoir de newsletter",
    "flash" => [
        "sendTo" => "Newsletter envoyé à ",
        "users" => " utilisateurs",
        "sorry" => " Désolé",
        "alreadyIn" => "Vous êtes déjà dans la newsletter !",
        "thanks" => "Merci",
        "subscribed" => "Vous êtes inscrit à la newsletter !",
        "bye" => "Vous ne faite plus partie de la newsletter",
        "notDefined" => "Réglages non définie !",
        "apply" => "Réglages appliqué.",
        "error-captcha" => "Merci de compléter le captcha",
        "error-sender" => "Vous n'avez pas définie de mail d'envoie ou de nom d'affichage !",
        "error-config" => "Il y à un problème dans votre configuration SMTP !",
        "externalUsersAdded" => "Utilisateur ajouté",
        "externalUsersDeleted" => "Utilisateur supprimé",
    ],
    "admin" => [
        "settings" => "Réglages",
        "captcha_hint" => "Activer le captcha ? (Paramétrable <a href='../security'>ici</a>)",
        "new_title" => "Nouvelle newsletter",
        "content" => " Contenu",
        "send" => "Envoyer",
        "alreadySent" => "Déja envoyé",
        "author" => "Auteur",
        "object" => "Objet",
        "date" => "Date",
        "dateCreated" => "Date d'ajout",
        "subscriber" => "Abonné(e)s",
        "mail" => "E-Mail",
        "mail-sender" => "Mails d'envoie :",
        "name-sender" => "Nom d'affichage :",
        "externalUsers" => [
            "title" => "Utilisateurs externes",
            "add" => [
                "title" => "Ajouter un utilisateur externe",

            ],
        ],
    ],
    "permissions" => [
        "newsletter" => [
            "send" => "Envoyer",
            "show" => "Afficher",
            "settings" => "Gérer les paramètres",
            "external" => [
                "users" => [
                    "add" => "Ajouter un utilisateur externe",
                    "delete" => "Supprimer un utilisateur externe",
                ],
            ],
        ],
    ],
];