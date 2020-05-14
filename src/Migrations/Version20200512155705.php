<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512155705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comorbidade DROP FOREIGN KEY FK_4D4B4A949D88E12C');
        $this->addSql('DROP INDEX IDX_4D4B4A949D88E12C ON comorbidade');
        $this->addSql('ALTER TABLE comorbidade DROP cidadao_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comorbidade ADD cidadao_id INT NOT NULL');
        $this->addSql('ALTER TABLE comorbidade ADD CONSTRAINT FK_4D4B4A949D88E12C FOREIGN KEY (cidadao_id) REFERENCES cidadao (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4D4B4A949D88E12C ON comorbidade (cidadao_id)');
    }
}
