<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506125450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456C0F37DD6');
        $this->addSql('DROP INDEX IDX_26A98456C0F37DD6 ON achat');
        $this->addSql('ALTER TABLE achat CHANGE le_client_id le_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845688A1A5E2 FOREIGN KEY (le_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_26A9845688A1A5E2 ON achat (le_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845688A1A5E2');
        $this->addSql('DROP INDEX IDX_26A9845688A1A5E2 ON achat');
        $this->addSql('ALTER TABLE achat CHANGE le_user_id le_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456C0F37DD6 FOREIGN KEY (le_client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_26A98456C0F37DD6 ON achat (le_client_id)');
    }
}
