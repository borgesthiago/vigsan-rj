<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512155004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comorbidade (id INT AUTO_INCREMENT NOT NULL, cidadao_id INT NOT NULL, nome VARCHAR(255) NOT NULL, INDEX IDX_4D4B4A949D88E12C (cidadao_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comorbidade ADD CONSTRAINT FK_4D4B4A949D88E12C FOREIGN KEY (cidadao_id) REFERENCES cidadao (id)');
        $this->addSql('ALTER TABLE cidadao ADD telefone VARCHAR(11) DEFAULT NULL, ADD bairro VARCHAR(100) DEFAULT NULL, ADD status VARCHAR(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comorbidade');
        $this->addSql('ALTER TABLE cidadao DROP telefone, DROP bairro, DROP status');
    }
}
