<?php use CMW\Controller\Core\SecurityController;
use CMW\Manager\Security\SecurityManager;
use CMW\Model\Newsletter\NewsletterSettingsModel;?>

<form action="newsletter" method="post">
    <?php (new SecurityManager())->insertHiddenToken() ?>
    <input type="email" name="newsletter_users_mail" placeholder="your@mail.com" required>
    <?php if(NewsletterSettingsModel::getInstance()->getConfig()->captchaIsEnable()):?>
        <?php SecurityController::getPublicData(); ?>
    <?php endif; ?>
    <button type="submit">Send</button>
</form>