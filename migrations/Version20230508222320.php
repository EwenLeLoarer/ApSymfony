<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508222320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E665194F937 FOREIGN KEY (le_article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_25056E665194F937 ON ligne_achat (le_article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E665194F937');
        $this->addSql('DROP INDEX UNIQ_25056E665194F937 ON ligne_achat');
    }
}
