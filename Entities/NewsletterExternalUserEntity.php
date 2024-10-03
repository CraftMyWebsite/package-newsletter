<?php

namespace CMW\Entity\Newsletter;

use CMW\Utils\Date;

class NewsletterExternalUserEntity
{
    private int $id;
    private string $email;
    private string $key;
    private string $dateCreated;
    private string $dateUpdated;

    /**
     * @param int $id
     * @param string $email
     * @param string $key
     * @param string $dateCreated
     * @param string $dateUpdated
     */
    public function __construct(int $id, string $email, string $key, string $dateCreated, string $dateUpdated)
    {
        $this->id = $id;
        $this->email = $email;
        $this->key = $key;
        $this->dateCreated = $dateCreated;
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * @return string
     */
    public function getDateCreatedFormatted(): string
    {
        return Date::formatDate($this->dateCreated);
    }

    /**
     * @return string
     */
    public function getDateUpdated(): string
    {
        return $this->dateUpdated;
    }

    /**
     * @return string
     */
    public function getDateUpdatedFormatted(): string
    {
        return Date::formatDate($this->dateUpdated);
    }
}
