<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

$title = LangManager::translate('newsletter.title');
$description = LangManager::translate('newsletter.description');

/* @var \CMW\Entity\Newsletter\NewsletterSettingEntity|null $config */
/** @var \CMW\Entity\Newsletter\NewsletterEntity[] $newsLetter */
/** @var \CMW\Entity\Newsletter\NewsletterUserEntity[] $newsLetterUser */
/* @var \CMW\Entity\Newsletter\NewsletterExternalUserEntity[] $externalUsers */
?>

<h3><i class="fa-solid fa-bullhorn"></i> <?= LangManager::translate('newsletter.title') ?></h3>

<div class="grid-2">
    <div class="card">
        <div class="lg:flex justify-between">
            <h6><?= LangManager::translate('newsletter.admin.new_title') ?></h6>
            <button form="sendMail" id="sendButton" type="submit" class="btn-primary"><?= LangManager::translate('core.btn.send') ?></button>
        </div>
        <form id="sendMail" method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <label for="newsletter_object">Objet :</label>
            <div class="input-group">
                <i class="fa-solid fa-envelope-open"></i>
                <input type="text" name="newsletter_object" id="newsletter_object" required
                       placeholder="<?= LangManager::translate('newsletter.admin.new_title') ?>">
            </div>
            <label for="newsletter_content"><?= LangManager::translate('newsletter.admin.content') ?> :</label>
            <textarea name="newsletter_content" id="newsletter_content" class="tinymce"></textarea>
        </form>
    </div>
    <div>
        <div class="card">
            <div class="lg:flex justify-between">
                <h6><?= LangManager::translate('newsletter.admin.settings') ?></h6>
                <button form="settings" type="submit" class="btn-primary"><?= LangManager::translate('core.btn.save') ?></button>
            </div>
            <form id="settings" action="settings" method="post">
                <?php SecurityManager::getInstance()->insertHiddenToken() ?>
                <div class="grid-2">
                    <div>
                        <label for="mail"><?= LangManager::translate('newsletter.admin.mail-sender') ?></label>
                        <div class="input-group">
                            <i class="fa-solid fa-at"></i>
                            <input type="text" id="mail" name="mail" required
                                   placeholder="no_reply@mail.com" value="<?= $config?->getSenderMail() ?>">
                        </div>
                    </div>
                    <div>
                        <label for="name"><?= LangManager::translate('newsletter.admin.name-sender') ?></label>
                        <div class="input-group">
                            <i class="fa-solid fa-signature"></i>
                            <input type="text" id="name" name="name" value="<?= $config?->getSenderName() ?>" required
                                   placeholder="Newsletter <?= Website::getWebsiteName() ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card mt-4">
            <h6><?= LangManager::translate('newsletter.admin.alreadySent') ?></h6>
            <div class="table-container table-container-striped">
                <table id="table1">
                    <thead>
                    <tr>
                        <th class="text-center"><?= LangManager::translate('newsletter.admin.author') ?></th>
                        <th class="text-center"><?= LangManager::translate('newsletter.admin.object') ?></th>
                        <th class="text-center"><?= LangManager::translate('newsletter.admin.date') ?></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php foreach ($newsLetter as $news): ?>
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
</div>


<div class="grid-2 mt-4">
    <div class="card">
        <h6><?= LangManager::translate('newsletter.admin.subscriber') ?></h6>
        <div class="table-container table-container-striped">
            <table class="table" id="table2">
                <thead>
                <tr>
                    <th class="text-center"><?= LangManager::translate('newsletter.admin.mail') ?></th>
                    <th class="text-center"><?= LangManager::translate('newsletter.admin.date') ?></th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php foreach ($newsLetterUser as $user): ?>
                    <tr>
                        <td><?= $user->getMail() ?></td>
                        <td><?= $user->getCreated() ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="lg:flex justify-between">
            <h6 class="col-11"><?= LangManager::translate('newsletter.admin.externalUsers.title') ?></h6>
            <button data-modal-toggle="modal-add" class="btn-primary" type="button"><i class="fas fa-add"></i> <?= LangManager::translate('core.btn.add') ?></button>
        </div>
        <div class="table-container table-container-striped">
            <table class="table" id="table3">
                <thead>
                <tr>
                    <th class="text-center"><?= LangManager::translate('newsletter.admin.mail') ?></th>
                    <th class="text-center"><?= LangManager::translate('newsletter.admin.dateCreated') ?></th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php foreach ($externalUsers as $externaluser): ?>
                    <tr>
                        <td><?= $externaluser->getEmail() ?></td>
                        <td><?= $externaluser->getDateCreatedFormatted() ?></td>
                        <td>
                            <a href="manage/external/users/delete/<?= $externaluser->getId() ?>" class="text-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="modal-add" class="modal-container">
    <div class="modal">
        <div class="modal-header">
            <h6>Titre de la modal</h6>
            <button type="button" data-modal-hide="modal-add"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form action="manage/external/users/add" method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken(); ?>
            <div class="modal-body">
                <label for="email"><?= LangManager::translate('users.users.mail') ?> :</label>
                <div class="input-group">
                    <i class="fa-solid fa-at"></i>
                    <input type="email" id="email" name="email" autocomplete="off"
                           placeholder="teyir@exemple.com" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-primary"><?= LangManager::translate('core.btn.save') ?></button>
            </div>
        </form>
    </div>
</div>