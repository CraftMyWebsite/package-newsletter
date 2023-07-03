<?php

namespace CMW\Entity\Newsletter;

use CMW\Controller\Core\CoreController;

class NewsletterSettingEntity
{
    private bool $newsletter_settings_captcha;
    private ?string $newsletter_settings_email;
    private ?string $newsletter_settings_sender_name;

    /**
     * @param bool $newsletter_settings_captcha
     * @param string $newsletter_settings_email
     * @param string $newsletter_settings_sender_name
     */
    public function __construct(bool $newsletter_settings_captcha, ?string $newsletter_settings_email, ?string $newsletter_settings_sender_name)
    {
        $this->newsletter_settings_captcha = $newsletter_settings_captcha;
        $this->newsletter_settings_email = $newsletter_settings_email;
        $this->newsletter_settings_sender_name = $newsletter_settings_sender_name;
    }

    /**
     * @return bool
     */
    public function captchaIsEnable(): bool
    {
        return $this->newsletter_settings_captcha;
    }

    /**
     * @return string
     */
    public function getSenderMail(): ?string
    {
        return $this->newsletter_settings_email;
    }

    /**
     * @return string
     */
    public function getSenderName(): ?string
    {
        return $this->newsletter_settings_sender_name;
    }

}