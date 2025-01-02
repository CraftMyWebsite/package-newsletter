<?php
use CMW\Controller\Core\SecurityController;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle('Newsletter');
Website::setDescription('Abonnez-vous !');
?>
<section style="width: 70%;padding-bottom: 6rem;margin: 1rem auto auto;">
<section style="padding: .5rem; max-width: 50%; margin: auto">
    <h5 style="text-align: center">Newsletter</h5>
    <form action="newsletter" method="post">
        <?php SecurityManager::getInstance()->insertHiddenToken() ?>
        <input type="email" style="display: block; width: 100%" name="newsletter_users_mail" placeholder="your@mail.com" required>
        <?php SecurityController::getPublicData(); ?>
        <button style="display: block; width: 100%; margin-top: 20px" type="submit">M'abonner</button>
    </form>
</section>
</section>