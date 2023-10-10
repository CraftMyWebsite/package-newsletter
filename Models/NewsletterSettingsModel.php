<?php

namespace CMW\Model\Newsletter;


use CMW\Entity\Newsletter\NewsletterSettingEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;


/**
 * Class @NewsletterModel
 * @package Newsletter
 * @author Zomb
 * @version 0.0.1
 */
class NewsletterSettingsModel extends AbstractModel
{

    public function getConfig(): ?NewsletterSettingEntity
    {
        $sql = "SELECT * FROM cmw_newsletter_settings LIMIT 1";

        $db = DatabaseManager::getInstance();
        $res = $db->prepare($sql);


        if (!$res->execute()) {
            return null;
        }

        $res = $res->fetch();

        if (!$res) {
            return null;
        }

        return new NewsletterSettingEntity(
            $res['newsletter_settings_email'],
            $res['newsletter_settings_sender_name']
        );
    }

    public function updateConfig(string $mail, string $name): ?NewsletterSettingEntity
    {
        $info = [
            "mail" => $mail,
            "name" => $name,
        ];

        if ($this->getConfig() === null){
            $sql = "INSERT INTO cmw_newsletter_settings (newsletter_settings_email, newsletter_settings_sender_name) 
                    VALUES (:mail, :name)";
        } else {
            $sql = "UPDATE cmw_newsletter_settings SET newsletter_settings_email = :mail, newsletter_settings_sender_name = :name";
        }

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute($info)) {
            return null;
        }

        return $this->getConfig();
    }

}
