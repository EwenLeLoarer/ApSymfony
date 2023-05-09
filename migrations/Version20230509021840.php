<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509021840 extends AbstractMigration
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
        $this->addSql('ALTER TABLE article CHANGE prix_article prix_article DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE carte_fidelité DROP numero_carte');
        $this->addSql('ALTER TABLE ligne_achat ADD le_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_achat ADD CONSTRAINT FK_25056E665194F937 FOREIGN KEY (le_article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_25056E665194F937 ON ligne_achat (le_article_id)');
        $this->addSql('ALTER TABLE promotions ADD le_article_id INT NOT NULL');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B30345194F937 FOREIGN KEY (le_article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EA1B30345194F937 ON promotions (le_article_id)');
        $this->addSql('ALTER TABLE user ADD la_carte_fidélité_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F927E4A FOREIGN KEY (la_carte_fidélité_id) REFERENCES carte_fidelité (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F927E4A ON user (la_carte_fidélité_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE prix_article prix_article INT NOT NULL');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845688A1A5E2');
        $this->addSql('DROP INDEX IDX_26A9845688A1A5E2 ON achat');
        $this->addSql('ALTER TABLE achat CHANGE le_user_id le_client_id INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456C0F37DD6 FOREIGN KEY (le_client_id) REFERENCES client (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_26A98456C0F37DD6 ON achat (le_client_id)');
        $this->addSql('ALTER TABLE ligne_achat DROP FOREIGN KEY FK_25056E665194F937');
        $this->addSql('DROP INDEX UNIQ_25056E665194F937 ON ligne_achat');
        $this->addSql('ALTER TABLE ligne_achat DROP le_article_id');
        $this->addSql('ALTER TABLE carte_fidelité ADD numero_carte INT NOT NULL');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B30345194F937');
        $this->addSql('DROP INDEX UNIQ_EA1B30345194F937 ON promotions');
        $this->addSql('ALTER TABLE promotions DROP le_article_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F927E4A');
        $this->addSql('DROP INDEX UNIQ_8D93D649F927E4A ON user');
        $this->addSql('ALTER TABLE user DROP la_carte_fidélité_id');
    }
}
