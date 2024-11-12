<?php
use CMW\Controller\Core\SecurityController;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Newsletter');
Website::setDescription('Abonnez-vous !');
?>
<?php if (\CMW\Controller\Users\UsersController::isAdminLogged()): ?>
    <div style="background-color: orange; padding: 6px; margin-bottom: 10px">
        <span>Votre thème ne gère pas cette page !</span>
        <br>
        <small>Seuls les administrateurs voient ce message !</small>
    </div>
<?php endif; ?>

<section style="padding: .5rem; max-width: 50%; margin: auto">
    <h5 style="text-align: center">Newsletter</h5>
    <form action="newsletter" method="post">
        <?php SecurityManager::getInstance()->insertHiddenToken() ?>
        <input type="email" style="display: block; width: 100%" name="newsletter_users_mail" placeholder="your@mail.com" required>
        <?php SecurityController::getPublicData(); ?>
        <button style="display: block; width: 100%; margin-top: 20px" type="submit">M'abonner</button>
    </form>
</section>