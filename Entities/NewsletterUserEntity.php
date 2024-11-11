<?php

namespace CMW\Entity\Newsletter;

use CMW\Manager\Package\AbstractEntity;
use CMW\Utils\Date;

class NewsletterUserEntity extends AbstractEntity
{
    private int $newsletter_users_id;
    private string $newsletter_users_mail;
    private string $newsletter_user_key;
    private string $newsletter_users_created;

    /**
     * @param int $newsletter_users_id
     * @param string $newsletter_users_mail
     * @param string $newsletter_user_key
     * @param string $newsletter_users_created
     */
    public function __construct(int $newsletter_users_id, string $newsletter_users_mail, string $newsletter_user_key, string $newsletter_users_created)
    {
        $this->newsletter_users_id = $newsletter_users_id;
        $this->newsletter_users_mail = $newsletter_users_mail;
        $this->newsletter_user_key = $newsletter_user_key;
        $this->newsletter_users_created = $newsletter_users_created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->newsletter_users_id;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->newsletter_users_mail;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->newsletter_user_key;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return Date::formatDate($this->newsletter_users_created);
    }
}
