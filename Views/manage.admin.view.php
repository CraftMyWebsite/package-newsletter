<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

$title = LangManager::translate("newsletter.title");
$description = LangManager::translate("newsletter.description");

/* @var \CMW\Entity\Newsletter\NewsletterSettingEntity $config */
/** @var \CMW\Entity\Newsletter\NewsletterEntity[] $newsLetter */
/** @var \CMW\Entity\Newsletter\NewsletterUserEntity[] $newsLetterUser */
?>

<div class="d-flex flex-wrap justify-content-between">
    <h3><i class="fa-solid fa-bullhorn"></i> <span
                class="m-lg-auto"><?= LangManager::translate("newsletter.title") ?></span></h3>
</div>


<section class="row">
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("newsletter.admin.settings") ?></h4>
            </div>
            <div class="card-body">
                <form action="settings" method="post">
                    <?php (new SecurityManager())->insertHiddenToken() ?>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="captcha" name="captcha" <?= $config->captchaIsEnable() ? 'checked' : '' ?>>
                            <label class="form-check-label" for="captcha"><?= LangManager::translate("newsletter.admin.captcha_hint") ?></label>
                        </div>
                    <h6><?= LangManager::translate("newsletter.admin.mail-sender") ?></h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="mail" required
                               placeholder="no_reply@mail.com" value="<?= $config->getSenderMail() ?>">
                        <div class="form-control-icon">
                            <i class="fa-solid fa-at"></i>
                        </div>
                    </div>
                    <h6><?= LangManager::translate("newsletter.admin.name-sender") ?></h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="name" value="<?= $config->getSenderName() ?>" required
                               placeholder="Newsletter <?= Website::getName()?>">
                        <div class="form-control-icon">
                            <i class="fa-solid fa-signature"></i>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary"><?= LangManager::translate("core.btn.save") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("newsletter.admin.new_title") ?></h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <?php (new SecurityManager())->insertHiddenToken() ?>
                    <h6>Objet :</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" name="newsletter_object" required
                               placeholder="<?= LangManager::translate("newsletter.admin.new_title") ?>">
                        <div class="form-control-icon">
                            <i class="fa-solid fa-envelope-open"></i>
                        </div>
                    </div>
                    <h6><?= LangManager::translate("newsletter.admin.content") ?> :</h6>
                    <textarea class="tinymce" name="newsletter_content"></textarea>
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary"><?= LangManager::translate("newsletter.admin.send") ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("newsletter.admin.alreadySent") ?></h4>
            </div>
            <div class="card-body">
                <table class="table" id="table2">
                    <thead>
                    <tr>
                        <th class="text-center"><?= LangManager::translate("newsletter.admin.author") ?></th>
                        <th class="text-center"><?= LangManager::translate("newsletter.admin.object") ?></th>
                        <th class="text-center"><?= LangManager::translate("newsletter.admin.date") ?></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php foreach ($newsLetter as $news) : ?>
                        <tr>
                            <td><?= $news->getAuthor()->getPseudo() ?></td>
                            <td><?= $news->getObject() ?></td>
                            <td><?= $news->getCreated() ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4><?= LangManager::translate("newsletter.admin.subscriber") ?></h4>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th class="text-center"><?= LangManager::translate("newsletter.admin.mail") ?></th>
                        <th class="text-center"><?= LangManager::translate("newsletter.admin.date") ?></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php foreach ($newsLetterUser as $user) : ?>
                        <tr>
                            <td><?= $user->getMail() ?></td>
                            <td><?= $user->getCreated() ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>