<?php

namespace CMW\Entity\Newsletter;

use CMW\Manager\Package\AbstractEntity;

class NewsletterSettingEntity extends AbstractEntity
{
    private ?string $newsletter_settings_email;
    private ?string $newsletter_settings_sender_name;

    /**
     * @param string|null $newsletter_settings_email
     * @param string|null $newsletter_settings_sender_name
     */
    public function __construct(?string $newsletter_settings_email, ?string $newsletter_settings_sender_name)
    {
        $this->newsletter_settings_email = $newsletter_settings_email;
        $this->newsletter_settings_sender_name = $newsletter_settings_sender_name;
    }

    /**
     * @return string|null
     */
    public function getSenderMail(): ?string
    {
        return $this->newsletter_settings_email;
    }

    /**
     * @return string|null
     */
    public function getSenderName(): ?string
    {
        return $this->newsletter_settings_sender_name;
    }
}
