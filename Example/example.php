<?php
use CMW\Controller\Core\SecurityController;
use CMW\Manager\Security\SecurityManager;
?>

<form action="newsletter" method="post">
    <?php SecurityManager::getInstance()->insertHiddenToken() ?>
    <input type="email" name="newsletter_users_mail" placeholder="your@mail.com" required>
    <?php SecurityController::getPublicData(); ?>
    <button type="submit">Send</button>
</form>