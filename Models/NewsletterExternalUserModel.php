<?php

namespace CMW\Model\Newsletter;

use CMW\Entity\Newsletter\NewsletterExternalUserEntity;
use CMW\Manager\Database\DatabaseManager;
use CMW\Manager\Package\AbstractModel;
use CMW\Manager\Security\EncryptManager;

class NewsletterExternalUserModel extends AbstractModel
{
    /**
     * @return \CMW\Entity\Newsletter\NewsletterExternalUserEntity[]
     */
    public function getExternalUsers(): array
    {
        $sql = 'SELECT * FROM cmw_newsletter_external_users';
        $db = DatabaseManager::getInstance();
        $req = $db->query($sql);

        if (!$req) {
            return [];
        }

        $res = $req->fetchAll();

        $toReturn = [];

        foreach ($res as $user) {
            $toReturn[] = new NewsletterExternalUserEntity(
                $user['id'],
                EncryptManager::decrypt($user['email']),
                $user['unique_key'],
                $user['date_created'],
                $user['date_updated'],
            );
        }

        return $toReturn;
    }

    /**
     * @param int $id
     * @return \CMW\Entity\Newsletter\NewsletterExternalUserEntity|null
     */
    public function getExternalUser(int $id): ?NewsletterExternalUserEntity
    {
        $sql = 'SELECT * FROM cmw_newsletter_external_users WHERE id = :id';
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['id' => $id])) {
            return null;
        }

        $res = $req->fetch();

        if (!$res) {
            return null;
        }

        return new NewsletterExternalUserEntity(
            $res['id'],
            EncryptManager::decrypt($res['email']),
            $res['unique_key'],
            $res['date_created'],
            $res['date_updated']
        );
    }

    /**
     * @param string $email
     * @return false|int
     */
    public function createExternalUser(string $email): false|int
    {
        $sql = 'INSERT INTO cmw_newsletter_external_users (email, unique_key) VALUES (:email, :unique_key)';
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['email' => $email, 'unique_key' => uniqid('', true)])) {
            return false;
        }

        return $db->lastInsertId();
    }

    public function isExternalUserExist(string $email): bool
    {
        $sql = 'SELECT email FROM cmw_newsletter_external_users WHERE email = :email';
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['email' => $email])) {
            return true;
        }

        $res = $req->fetchAll();

        if (!$res) {
            return false;
        }

        return count($res) >= 1;
    }

    /**
     * @param string $email (encrypted email) see {@CMW\Manager\Security\EncryptManager}
     * @return bool
     */
    public function deleteExternalUser(string $email): bool
    {
        $sql = 'DELETE FROM cmw_newsletter_external_users WHERE email = :email';
        $db = DatabaseManager::getInstance();
        $req = $db->prepare($sql);

        if (!$req->execute(['email' => $email])) {
            return false;
        }

        return $req->rowCount() === 1;
    }
}
