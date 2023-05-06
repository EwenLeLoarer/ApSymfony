<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506164328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_fidelité DROP numero_carte');
        $this->addSql('ALTER TABLE user ADD la_carte_fidélité_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F927E4A FOREIGN KEY (la_carte_fidélité_id) REFERENCES carte_fidelité (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F927E4A ON user (la_carte_fidélité_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carte_fidelité ADD numero_carte INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F927E4A');
        $this->addSql('DROP INDEX UNIQ_8D93D649F927E4A ON user');
        $this->addSql('ALTER TABLE user DROP la_carte_fidélité_id');
    }
}
