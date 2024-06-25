<?php

namespace CMW\Controller\Newsletter;

use CMW\Controller\Core\MailController;
use CMW\Controller\Core\SecurityController;
use CMW\Controller\Users\UsersController;
use CMW\Manager\Env\EnvManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Requests\Request;
use CMW\Manager\Router\Link;
use CMW\Manager\Security\EncryptManager;
use CMW\Manager\Views\View;
use CMW\Model\Core\MailModel;
use CMW\Model\Newsletter\NewsletterExternalUserModel;
use CMW\Model\Newsletter\NewsletterModel;
use CMW\Model\Newsletter\NewsletterSettingsModel;
use CMW\Model\Newsletter\NewsletterUserModel;
use CMW\Model\Users\UsersModel;
use CMW\Utils\Redirect;
use CMW\Utils\Utils;
use CMW\Utils\Website;


/**
 * Class: @NewsletterController
 * @package Newsletter
 * @author Zomb
 * @version 0.0.1
 */
class NewsletterController extends AbstractController
{
    #[Link(path: "/", method: Link::GET, scope: "/cmw-admin/newsletter")]
    #[Link("/manage", Link::GET, [], "/cmw-admin/newsletter")]
    public function newsletter(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "newsletter.show");

        $newsLetter = NewsletterModel::getInstance()->getNewsletter();
        $newsLetterUser = NewsletterUserModel::getInstance()->getNewsletterUsers();
        $config = NewsletterSettingsModel::getInstance()->getConfig();
        $externalUsers = NewsletterExternalUserModel::getInstance()->getExternalUsers();

        View::createAdminView('Newsletter', 'manage')
            ->addStyle("Admin/Resources/Assets/Css/simple-datatables.css")
            ->addScriptAfter("Admin/Resources/Vendors/Simple-datatables/Umd/simple-datatables.js",
                "Admin/Resources/Vendors/Simple-datatables/config-datatables.js","App/Package/Newsletter/Views/Resources/sendMail.js")
            ->addScriptBefore("Admin/Resources/Vendors/Tinymce/tinymce.min.js",
                "Admin/Resources/Vendors/Tinymce/Config/full.js")
            ->addVariableList(["newsLetter" => $newsLetter, "newsLetterUser" => $newsLetterUser, "config" => $config,
                "externalUsers" => $externalUsers])
            ->view();
    }

    #[Link("/manage", Link::POST, [], "/cmw-admin/newsletter", secure: false)]
    public function newsletterPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "newsletter.show.send");

        $config = NewsletterSettingsModel::getInstance()->getConfig();

        if ($config === null) {
            echo json_encode(array("status" => "error", "message" => LangManager::translate("newsletter.flash.error-sender")));
        } else if (!MailModel::getInstance()->getConfig()?->isEnable()) {
            echo json_encode(array("status" => "error", "message" => LangManager::translate("newsletter.flash.error-config")));
        } else {
            $i = 0;
            [$newsletter_object, $newsletter_content] = Utils::filterInput("newsletter_object", "newsletter_content");
            $user_id = UsersModel::getCurrentUser()?->getId();
            $url = Website::getProtocol() . '://' . $_SERVER['SERVER_NAME'] . EnvManager::getInstance()->getValue("PATH_SUBFOLDER") . 'newsletter/unsubscribe/';
            foreach (NewsletterUserModel::getInstance()->getNewsletterUsers() as $mail) {
                MailController::getInstance()->sendMailWithSender($config->getSenderMail(), $config->getSenderName(), $mail->getMail(), $newsletter_object, $newsletter_content . "<br><br><small><a href='" . $url . $mail->getKey() . "' target='_blank'>" . LangManager::translate("newsletter.unsubscribe") . "</a></small>");
                $i++;
            }
            foreach (NewsletterExternalUserModel::getInstance()->getExternalUsers() as $externalUser) {
                MailController::getInstance()->sendMailWithSender($config->getSenderMail(), $config->getSenderName(), $externalUser->getEmail(), $newsletter_object, $newsletter_content . "<br><br><small><a href='" . $url . $externalUser->getKey() . "' target='_blank'>" . LangManager::translate("newsletter.unsubscribe") . "</a></small>");
                $i++;
            }
            NewsletterModel::getInstance()->createNewsletter($user_id, $newsletter_object, $newsletter_content);
            echo json_encode(array("status" => "success", "message" => LangManager::translate("newsletter.flash.sendTo") . $i . LangManager::translate("newsletter.flash.users")));
        }
    }

    #[Link("/settings", Link::POST, [], "/cmw-admin/newsletter")]
    public function settingsPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "newsletter.show.settings");

        [$mail, $name] = Utils::filterInput("mail", "name");

        NewsletterSettingsModel::getInstance()->updateConfig($mail, $name);

        Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"), LangManager::translate("newsletter.flash.apply"));

        Redirect::redirectPreviousRoute();
    }

    #[Link("/manage/external/users/delete/:id", Link::GET, ['id' => '[0-9+]'], "/cmw-admin/newsletter")]
    public function newsletterExternalUsersDelete(Request $request, int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "newsletter.users.delete");

        $user = NewsletterExternalUserModel::getInstance()->getExternalUser($id);

        if ($user === null) {
            Flash::send(Alert::ERROR, LangManager::translate("core.toaster.error"),
                LangManager::translate("core.users.not_registered_account"));
            Redirect::redirectPreviousRoute();
        }

        if (!NewsletterExternalUserModel::getInstance()->deleteExternalUser(EncryptManager::encrypt($user->getEmail()))) {
            Flash::send(Alert::ERROR, LangManager::translate("core.toaster.error"),
                LangManager::translate("core.toaster.internalError"));
        } else {

            Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"),
                LangManager::translate("newsletter.flash.externalUsersDeleted"));
        }
        Redirect::redirectPreviousRoute();
    }

    #[Link("/manage/external/users/add", Link::POST, [], "/cmw-admin/newsletter")]
    public function newsletterExternalUsersAdd(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "newsletter.users.add");

        [$email] = Utils::filterInput("email");

        $email = EncryptManager::encrypt($email);

        if (!NewsletterExternalUserModel::getInstance()->createExternalUser($email)) {
            Flash::send(Alert::ERROR, LangManager::translate("core.toaster.error"),
                LangManager::translate("core.toaster.internalError"));
        } else {

            Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"),
                LangManager::translate("newsletter.flash.externalUsersAdded"));
        }
        Redirect::redirectPreviousRoute();
    }

    /*----------PUBLIC POST----------*/
    #[Link("/", Link::POST, [], "/newsletter")]
    public function addNewsletterUserPost(): void
    {
        $config = NewsletterSettingsModel::getInstance()->getConfig();

        if ($config === null) {
            Flash::send(Alert::ERROR, LangManager::translate('core.toaster.error'),
                LangManager::translate("newsletter.flash.notDefined"));
            Redirect::redirectPreviousRoute();
        }

        if (SecurityController::checkCaptcha()) {
            [$newsletter_users_mail] = Utils::filterInput("newsletter_users_mail");
            if (NewsletterUserModel::getInstance()->userExist($newsletter_users_mail)) {
                Flash::send(Alert::ERROR, LangManager::translate("newsletter.flash.sorry"), LangManager::translate("newsletter.flash.alreadyIn"));
                Redirect::redirectPreviousRoute();
            }
            NewsletterUserModel::getInstance()->addNewsletterUser($newsletter_users_mail);
            Flash::send(Alert::SUCCESS, LangManager::translate("newsletter.flash.thanks"), LangManager::translate("newsletter.flash.subscribed"));

        } else {
            Flash::send(Alert::ERROR, LangManager::translate("core.toaster.error"),
                LangManager::translate("newsletter.flash.error-captcha"));
        }
        Redirect::redirectPreviousRoute();
    }

    #[Link("/unsubscribe/:key", Link::GET, ["id" => "[0-9]+"], "/newsletter")]
    public function unsubscribeNewsletter(Request $request, string $key): void
    {
        NewsletterUserModel::getInstance()->deleteUser($key);
        NewsletterUserModel::getInstance()->deleteExternalUser($key);

        Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"), LangManager::translate("newsletter.flash.bye"));

        Redirect::redirectToHome();
    }
}
