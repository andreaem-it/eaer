<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190228140456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classification__category DROP FOREIGN KEY FK_43629B36727ACA70');
        $this->addSql('ALTER TABLE news__post DROP FOREIGN KEY FK_7D109BC8514956FD');
        $this->addSql('ALTER TABLE classification__category DROP FOREIGN KEY FK_43629B36E25D857E');
        $this->addSql('ALTER TABLE classification__collection DROP FOREIGN KEY FK_A406B56AE25D857E');
        $this->addSql('ALTER TABLE classification__tag DROP FOREIGN KEY FK_CA57A1C7E25D857E');
        $this->addSql('ALTER TABLE news__post_tag DROP FOREIGN KEY FK_682B2051BAD26311');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE news__post DROP FOREIGN KEY FK_7D109BC8F675F31B');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C5414E7AF8F');
        $this->addSql('ALTER TABLE classification__category DROP FOREIGN KEY FK_43629B36EA9FDD75');
        $this->addSql('ALTER TABLE classification__collection DROP FOREIGN KEY FK_A406B56AEA9FDD75');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C541EA9FDD75');
        $this->addSql('ALTER TABLE news__post DROP FOREIGN KEY FK_7D109BC83DA5256D');
        $this->addSql('ALTER TABLE news__comment DROP FOREIGN KEY FK_A90210404B89032C');
        $this->addSql('ALTER TABLE news__post_tag DROP FOREIGN KEY FK_682B20514B89032C');
        $this->addSql('ALTER TABLE page__block DROP FOREIGN KEY FK_66F58DA0727ACA70');
        $this->addSql('ALTER TABLE page__block DROP FOREIGN KEY FK_66F58DA0C4663E4');
        $this->addSql('ALTER TABLE page__page DROP FOREIGN KEY FK_2FAE39ED158E0B66');
        $this->addSql('ALTER TABLE page__page DROP FOREIGN KEY FK_2FAE39ED727ACA70');
        $this->addSql('ALTER TABLE page__snapshot DROP FOREIGN KEY FK_3963EF9AC4663E4');
        $this->addSql('ALTER TABLE page__page DROP FOREIGN KEY FK_2FAE39EDF6BD1646');
        $this->addSql('ALTER TABLE page__snapshot DROP FOREIGN KEY FK_3963EF9AF6BD1646');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, datetime DATETIME NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_items (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, active TINYINT(1) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, parent INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE classification__category');
        $this->addSql('DROP TABLE classification__collection');
        $this->addSql('DROP TABLE classification__context');
        $this->addSql('DROP TABLE classification__tag');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE media__gallery');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('DROP TABLE menuitems');
        $this->addSql('DROP TABLE news__comment');
        $this->addSql('DROP TABLE news__post');
        $this->addSql('DROP TABLE news__post_tag');
        $this->addSql('DROP TABLE page__block');
        $this->addSql('DROP TABLE page__page');
        $this->addSql('DROP TABLE page__site');
        $this->addSql('DROP TABLE page__snapshot');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classification__category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, context VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, media_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, position INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_43629B36E25D857E (context), INDEX IDX_43629B36727ACA70 (parent_id), INDEX IDX_43629B36EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classification__collection (id INT AUTO_INCREMENT NOT NULL, context VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, media_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A406B56AEA9FDD75 (media_id), UNIQUE INDEX tag_collection (slug, context), INDEX IDX_A406B56AE25D857E (context), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classification__context (id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classification__tag (id INT AUTO_INCREMENT NOT NULL, context VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX tag_context (slug, context), INDEX IDX_CA57A1C7E25D857E (context), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, username_canonical VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, email_canonical VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, lastname VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, website VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, biography VARCHAR(1000) DEFAULT NULL COLLATE utf8mb4_unicode_ci, gender VARCHAR(1) DEFAULT NULL COLLATE utf8mb4_unicode_ci, locale VARCHAR(8) DEFAULT NULL COLLATE utf8mb4_unicode_ci, timezone VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, facebook_uid VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, facebook_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, facebook_data JSON DEFAULT NULL COLLATE utf8mb4_unicode_ci, twitter_uid VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, twitter_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, twitter_data JSON DEFAULT NULL COLLATE utf8mb4_unicode_ci, gplus_uid VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, gplus_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, gplus_data JSON DEFAULT NULL COLLATE utf8mb4_unicode_ci, token VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, two_step_code VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media__gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, context VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, default_format VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media__gallery_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_80D4C541EA9FDD75 (media_id), INDEX IDX_80D4C5414E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media__media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description TEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, provider_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, provider_metadata JSON DEFAULT NULL COLLATE utf8mb4_unicode_ci, width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, author_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, context VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menuitems (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, url LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, active TINYINT(1) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news__comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, url VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, message LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, status INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A90210404B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news__post (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, author_id INT DEFAULT NULL, collection_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, abstract LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, raw_content LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, content_formatter VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, publication_date_start DATETIME DEFAULT NULL, comments_enabled TINYINT(1) NOT NULL, comments_close_at DATETIME DEFAULT NULL, comments_default_status INT NOT NULL, comments_count INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_7D109BC8F675F31B (author_id), INDEX IDX_7D109BC83DA5256D (image_id), INDEX IDX_7D109BC8514956FD (collection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news__post_tag (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_682B20514B89032C (post_id), INDEX IDX_682B2051BAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE page__block (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, page_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, settings JSON NOT NULL COLLATE utf8mb4_unicode_ci, enabled TINYINT(1) DEFAULT NULL, position INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_66F58DA0C4663E4 (page_id), INDEX IDX_66F58DA0727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE page__page (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, target_id INT DEFAULT NULL, route_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, page_alias VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, position INT NOT NULL, enabled TINYINT(1) NOT NULL, decorate TINYINT(1) NOT NULL, edited TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, slug LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, url LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, custom_url LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, request_method VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, title VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, meta_keyword VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, meta_description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, javascript LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, stylesheet LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, raw_headers LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, template VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2FAE39ED727ACA70 (parent_id), INDEX IDX_2FAE39EDF6BD1646 (site_id), INDEX IDX_2FAE39ED158E0B66 (target_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE page__site (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, relative_path VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, host VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, enabled_from DATETIME DEFAULT NULL, enabled_to DATETIME DEFAULT NULL, is_default TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, locale VARCHAR(7) DEFAULT NULL COLLATE utf8mb4_unicode_ci, title VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_unicode_ci, meta_keywords VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, meta_description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE page__snapshot (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, page_id INT DEFAULT NULL, route_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, page_alias VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, position INT NOT NULL, enabled TINYINT(1) NOT NULL, decorate TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, url LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, parent_id INT DEFAULT NULL, target_id INT DEFAULT NULL, content JSON DEFAULT NULL COLLATE utf8mb4_unicode_ci, publication_date_start DATETIME DEFAULT NULL, publication_date_end DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3963EF9AC4663E4 (page_id), INDEX IDX_3963EF9AF6BD1646 (site_id), INDEX idx_snapshot_dates_enabled (publication_date_start, publication_date_end, enabled), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE classification__category ADD CONSTRAINT FK_43629B36727ACA70 FOREIGN KEY (parent_id) REFERENCES classification__category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classification__category ADD CONSTRAINT FK_43629B36E25D857E FOREIGN KEY (context) REFERENCES classification__context (id)');
        $this->addSql('ALTER TABLE classification__category ADD CONSTRAINT FK_43629B36EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE classification__collection ADD CONSTRAINT FK_A406B56AE25D857E FOREIGN KEY (context) REFERENCES classification__context (id)');
        $this->addSql('ALTER TABLE classification__collection ADD CONSTRAINT FK_A406B56AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE classification__tag ADD CONSTRAINT FK_CA57A1C7E25D857E FOREIGN KEY (context) REFERENCES classification__context (id)');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C5414E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C541EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news__comment ADD CONSTRAINT FK_A90210404B89032C FOREIGN KEY (post_id) REFERENCES news__post (id)');
        $this->addSql('ALTER TABLE news__post ADD CONSTRAINT FK_7D109BC83DA5256D FOREIGN KEY (image_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE news__post ADD CONSTRAINT FK_7D109BC8514956FD FOREIGN KEY (collection_id) REFERENCES classification__collection (id)');
        $this->addSql('ALTER TABLE news__post ADD CONSTRAINT FK_7D109BC8F675F31B FOREIGN KEY (author_id) REFERENCES fos_user_user (id)');
        $this->addSql('ALTER TABLE news__post_tag ADD CONSTRAINT FK_682B20514B89032C FOREIGN KEY (post_id) REFERENCES news__post (id)');
        $this->addSql('ALTER TABLE news__post_tag ADD CONSTRAINT FK_682B2051BAD26311 FOREIGN KEY (tag_id) REFERENCES classification__tag (id)');
        $this->addSql('ALTER TABLE page__block ADD CONSTRAINT FK_66F58DA0727ACA70 FOREIGN KEY (parent_id) REFERENCES page__block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__block ADD CONSTRAINT FK_66F58DA0C4663E4 FOREIGN KEY (page_id) REFERENCES page__page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__page ADD CONSTRAINT FK_2FAE39ED158E0B66 FOREIGN KEY (target_id) REFERENCES page__page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__page ADD CONSTRAINT FK_2FAE39ED727ACA70 FOREIGN KEY (parent_id) REFERENCES page__page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__page ADD CONSTRAINT FK_2FAE39EDF6BD1646 FOREIGN KEY (site_id) REFERENCES page__site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__snapshot ADD CONSTRAINT FK_3963EF9AC4663E4 FOREIGN KEY (page_id) REFERENCES page__page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page__snapshot ADD CONSTRAINT FK_3963EF9AF6BD1646 FOREIGN KEY (site_id) REFERENCES page__site (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE menu_items');
        $this->addSql('DROP TABLE categories');
    }
}
