<?php

return [
    "title" => "Newsletter",
    "description" => "Manage your newsletters",
    "unsubscribe" => "Stop receiving newsletters",
    "flash" => [
        "sendTo" => "Newsletter sent to ",
        "users" => " users",
        "sorry" => " Sorry",
        "alreadyIn" => "You are already in the newsletter!",
        "thanks" => "THANKS",
        "subscribed" => "You are subscribed to the newsletter!",
        "bye" => "You are no longer part of the newsletter",
        "notDefined" => "Settings not defined !",
        "apply" => "Settings applied.",
        "error-captcha" => "Please complete the captcha.",
        "error-sender" => "You have not defined a sending email or a display name!",
        "error-config" => "There is a problem in your SMTP configuration!",
        "externalUsersAdded" => "User added",
        "externalUsersDeleted" => "User deleted",
    ],
    "admin" => [
        "settings" => "Settings",
        "externalUsersTitle" => "External users",
        "captcha_hint" => "Enable captcha? (Configurable <a href='../security'>here</a>)",
        "new_title" => "New newsletter",
        "content" => " Content",
        "send" => "Send",
        "alreadySent" => "Already sent",
        "author" => "Author",
        "object" => "Object",
        "date" => "Date",
        "dateCreated" => "Date added",
        "subscriber" => "Subscribers",
        "mail" => "E-Mail",
        "mail-sender" => "Sending emails: ",
        "name-sender" => "Display name :",
        "externalUsers" => [
            "title" => "External users",
            "add" => [
                "title" => "Add an external user",

            ],
        ],
    ],
    "permissions" => [
        "newsletter" => [
            "send" => "Send",
            "show" => "Show",
            "settings" => "Manager settings",
            "external" => [
                "users" => [
                    "add" => "Add external user",
                    "delete" => "Delete external user",
                ],
            ],
        ],
    ],
];