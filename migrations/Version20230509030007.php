<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509030007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, le_user_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, data_achat DATETIME NOT NULL, total_points INT NOT NULL, INDEX IDX_26A9845688A1A5E2 (le_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, la_promotion_id INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, prix_article DOUBLE PRECISION NOT NULL, point_article INT NOT NULL, image_url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_23A0E6687785400 (la_promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_fidelité (id INT AUTO_INCREMENT NOT NULL, points INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, la_carte_fidélité_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, telephone INT NOT NULL, UNIQUE INDEX UNIQ_C7440455F927E4A (la_carte_fidélité_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_achat (id INT AUTO_INCREMENT NOT NULL, le_achat_id INT NOT NULL, le_article_id INT NOT NULL, quantity INT NOT NULL, sous_total DOUBLE PRECISION NOT NULL, sous_total_points DOUBLE PRECISION NOT NULL, INDEX IDX_25056E6630DBFAFE (le_achat_id), UNIQUE INDEX UNIQ_25056E665194F937 (le_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotions (id INT AUTO_INCREMENT NOT NULL, le_article_id INT NOT NULL, description VARCHAR(255) NOT NULL, reduction DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_EA1B30345194F937 (le_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, la_carte_fidélité_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F927E4A (la_carte_fidélité_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845688A1A5E2 FOREIGN KEY (le_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6687785400 FOREIGN KEY (la_promotion_id) REFERENCES promotions (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F927E4A FOREIGN KEY (la_carte_fidélité_id) REFERENCES carte_fidelité (id)');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E6630DBFAFE FOREIGN KEY (le_achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E665194F937 FOREIGN KEY (le_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B30345194F937 FOREIGN KEY (le_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F927E4A FOREIGN KEY (la_carte_fidélité_id) REFERENCES carte_fidelité (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845688A1A5E2');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6687785400');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455F927E4A');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E6630DBFAFE');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E665194F937');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B30345194F937');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F927E4A');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE carte_fidelité');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE ligne_achat');
        $this->addSql('DROP TABLE promotions');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
