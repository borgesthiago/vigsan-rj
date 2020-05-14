<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512155815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidadao ADD comorbidade_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cidadao ADD CONSTRAINT FK_9D4D3AC77C3EAC6 FOREIGN KEY (comorbidade_id) REFERENCES comorbidade (id)');
        $this->addSql('CREATE INDEX IDX_9D4D3AC77C3EAC6 ON cidadao (comorbidade_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidadao DROP FOREIGN KEY FK_9D4D3AC77C3EAC6');
        $this->addSql('DROP INDEX IDX_9D4D3AC77C3EAC6 ON cidadao');
        $this->addSql('ALTER TABLE cidadao DROP comorbidade_id');
    }
}
