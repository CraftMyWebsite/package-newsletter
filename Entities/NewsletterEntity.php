<?php

namespace CMW\Entity\Newsletter;

use CMW\Utils\Date;
use CMW\Entity\Users\UserEntity;

class NewsletterEntity
{
    private int $newsletter_id;
    private UserEntity $user_id;
    private string $newsletter_object;
    private string $newsletter_content;
    private string $newsletter_created;

    /**
     * @param int $newsletter_id
     * @param string $newsletter_object
     * @param string $newsletter_content
     * @param string $newsletter_created
     * @param UserEntity $user_id
     */
    public function __construct(int $newsletter_id, UserEntity $user_id, string $newsletter_object, string $newsletter_content, string $newsletter_created)
    {
        $this->newsletter_id = $newsletter_id;
        $this->user_id = $user_id;
        $this->newsletter_object = $newsletter_object;
        $this->newsletter_content = $newsletter_content;
        $this->newsletter_created = $newsletter_created;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->newsletter_id;
    }

    /**
     * @return UserEntity
     */
    public function getAuthor(): UserEntity
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getObject(): string
    {
        return $this->newsletter_object;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->newsletter_content;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return Date::formatDate($this->newsletter_created);
    }
}
