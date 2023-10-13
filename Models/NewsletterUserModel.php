<?php

namespace CMW\Model\Newsletter;

use CMW\Entity\Newsletter\NewsletterUserEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;


/**
 * Class @NewsletterUserModel
 * @package Newsletter
 * @author Zomb
 * @version 0.0.1
 */
class NewsletterUserModel extends AbstractModel
{


    /**
     * @return \CMW\Entity\Newsletter\NewsletterUserEntity []
     */
    public function getNewsletterUsers(): array
    {

        $sql = "SELECT newsletter_users_id FROM cmw_newsletter_users";
        $db = DatabaseManager::getInstance();

        $res = $db->prepare($sql);

        if (!$res->execute()) {
            return array();
        }

        $toReturn = array();

        while ($cat = $res->fetch()) {
            $toReturn[] = $this->getNewsletterUserById($cat["newsletter_users_id"]);
        }

        return $toReturn;

    }

    public function getNewsletterUserById(int $newsletter_users_id): ?NewsletterUserEntity
    {
        $sql = "SELECT * FROM cmw_newsletter_users WHERE newsletter_users_id = :newsletter_users_id";

        $db = DatabaseManager::getInstance();

        $res = $db->prepare($sql);

        if (!$res->execute(array("newsletter_users_id" => $newsletter_users_id))) {
            return null;
        }

        $res = $res->fetch();

        return new NewsletterUserEntity(
            $res["newsletter_users_id"],
            $res["newsletter_users_mail"],
            $res["newsletter_user_key"],
            $res["newsletter_created"]
        );
    }

    public function userExist(string $newsletter_users_mail): bool
    {
        $sql = "SELECT newsletter_users_id FROM cmw_newsletter_users WHERE newsletter_users_mail = :newsletter_users_mail";

        $db = DatabaseManager::getInstance();
        $res = $db->prepare($sql);

        if ($res->execute(array("newsletter_users_mail" => $newsletter_users_mail))) {
            return $res->rowCount() === 1;
        }
        return false;
    }

    public function addNewsletterUser(string $newsletter_users_mail): void
    {
        $data = array(
            "newsletter_users_mail" => $newsletter_users_mail,
            'newsletter_user_key' => uniqid('', true)
        );
        $sql = "INSERT INTO cmw_newsletter_users(newsletter_users_mail, newsletter_user_key) VALUES (:newsletter_users_mail, :newsletter_user_key)";

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        $req->execute($data);
    }

    /**
     * @param int $newsletter_user_key
     * @return void
     */
    public function deleteUser(string $newsletter_user_key): void
    {
        $sql = "DELETE FROM cmw_newsletter_users WHERE newsletter_user_key=:newsletter_user_key";

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array("newsletter_user_key" => $newsletter_user_key));
    }

    /**
     * @param int $newsletter_user_key
     * @return void
     */
    public function deleteExternalUser(string $newsletter_user_key): void
    {
        $sql = "DELETE FROM cmw_newsletter_external_users WHERE unique_key=:newsletter_user_key";

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);
        $req->execute(array("newsletter_user_key" => $newsletter_user_key));
    }
}
