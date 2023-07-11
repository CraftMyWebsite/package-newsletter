CREATE TABLE if not exists `cmw_newsletter`
(
    `newsletter_id`      INT          NOT NULL AUTO_INCREMENT,
    `user_id`            INT(11)      NULL,
    `newsletter_object`  VARCHAR(255) NOT NULL,
    `newsletter_content` LONGTEXT     NOT NULL,
    `newsletter_created` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_newsletter_users FOREIGN KEY (user_id) REFERENCES cmw_users (user_id) ON UPDATE CASCADE ON DELETE SET NULL,
    PRIMARY KEY (`newsletter_id`)
) ENGINE = InnoDB
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE if not exists `cmw_newsletter_settings`
(
    `newsletter_settings_captcha` TINYINT NOT NULL,
    `newsletter_settings_email`  VARCHAR(100) NULL,
    `newsletter_settings_sender_name`  VARCHAR(100) NULL
) ENGINE = InnoDB
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
INSERT INTO cmw_newsletter_settings (newsletter_settings_captcha)
VALUES (0);

CREATE TABLE if not exists `cmw_newsletter_users`
(
    `newsletter_users_id`      INT          NOT NULL AUTO_INCREMENT,
    `newsletter_users_mail`            VARCHAR(50)      NULL,
    `newsletter_user_key`       VARCHAR(255) NOT NULL,
    `newsletter_created` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`newsletter_users_id`)
) ENGINE = InnoDB
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
