<?php

namespace CMW\Model\Newsletter;


use CMW\Entity\Newsletter\NewsletterEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;
use CMW\Model\Users\UsersModel;


/**
 * Class @NewsletterModel
 * @package Newsletter
 * @author Zomb
 * @version 0.0.1
 */
class NewsletterModel extends AbstractModel
{

    /**
     * @return \CMW\Entity\Newsletter\NewsletterEntity[]
     */
    public function getNewsletter(): array
    {

        $sql = "SELECT newsletter_id FROM cmw_newsletter";
        $db = DatabaseManager::getInstance();

        $res = $db->prepare($sql);

        if (!$res->execute()) {
            return array();
        }

        $toReturn = array();

        while ($cat = $res->fetch()) {
            $toReturn[] = $this->getNewsletterById($cat["newsletter_id"]);
        }

        return $toReturn;

    }

    public function getNewsletterById(int $newsletter_id): ? NewsletterEntity
    {
        $sql = "SELECT * FROM cmw_newsletter WHERE newsletter_id = :newsletter_id";

        $db = DatabaseManager::getInstance();

        $res = $db->prepare($sql);

        if (!$res->execute(array("newsletter_id" => $newsletter_id))) {
            return null;
        }

        $res = $res->fetch();

        $user = (new UsersModel())->getUserById($res["user_id"]);

        return new NewsletterEntity(
            $res["newsletter_id"],
            $user,
            $res["newsletter_object"],
            $res["newsletter_content"],
            $res["newsletter_created"]
        );
    }

    public function createNewsletter(int $user_id, string $newsletter_object, string $newsletter_content): void
    {

        $data = array(
            "user_id" => $user_id,
            "newsletter_object" => $newsletter_object,
            "newsletter_content" => $newsletter_content
        );

        $sql = "INSERT INTO cmw_newsletter(user_id, newsletter_object, newsletter_content) VALUES (:user_id, :newsletter_object, :newsletter_content)";

        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        $req->execute($data);
    }

}
