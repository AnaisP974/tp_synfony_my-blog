<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926091513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, timestamps_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(4, 2) NOT NULL, features LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_29D6873ED8BDA32 (timestamps_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, signature_id INT NOT NULL, timestamps_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, is_public TINYINT(1) NOT NULL, is_premium TINYINT(1) NOT NULL, INDEX IDX_5A8A6C8DED61183A (signature_id), UNIQUE INDEX UNIQ_5A8A6C8DD8BDA32 (timestamps_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, offer_id_id INT NOT NULL, timestamps_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_A3C664D39D86650F (user_id_id), INDEX IDX_A3C664D3FC69E3BE (offer_id_id), UNIQUE INDEX UNIQ_A3C664D3D8BDA32 (timestamps_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timestamps (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, timestamps_id INT NOT NULL, fullname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649D8BDA32 (timestamps_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873ED8BDA32 FOREIGN KEY (timestamps_id) REFERENCES timestamps (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DED61183A FOREIGN KEY (signature_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DD8BDA32 FOREIGN KEY (timestamps_id) REFERENCES timestamps (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3FC69E3BE FOREIGN KEY (offer_id_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3D8BDA32 FOREIGN KEY (timestamps_id) REFERENCES timestamps (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D8BDA32 FOREIGN KEY (timestamps_id) REFERENCES timestamps (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873ED8BDA32');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DED61183A');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DD8BDA32');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D39D86650F');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3FC69E3BE');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3D8BDA32');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D8BDA32');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE timestamps');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
