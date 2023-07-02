<?php

namespace CMW\Entity\Newsletter;

use CMW\Controller\Core\CoreController;

class NewsletterSettingEntity
{
    private bool $newsletter_settings_captcha;

    /**
     * @param bool $newsletter_settings_captcha
     */
    public function __construct(bool $newsletter_settings_captcha)
    {
        $this->newsletter_settings_captcha = $newsletter_settings_captcha;
    }

    /**
     * @return bool
     */
    public function captchaIsEnable(): bool
    {
        return $this->newsletter_settings_captcha;
    }

}