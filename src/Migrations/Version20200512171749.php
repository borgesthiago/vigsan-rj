<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512171749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cidadao_comorbidade (cidadao_id INT NOT NULL, comorbidade_id INT NOT NULL, INDEX IDX_2EE16219D88E12C (cidadao_id), INDEX IDX_2EE162177C3EAC6 (comorbidade_id), PRIMARY KEY(cidadao_id, comorbidade_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cidadao_comorbidade ADD CONSTRAINT FK_2EE16219D88E12C FOREIGN KEY (cidadao_id) REFERENCES cidadao (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cidadao_comorbidade ADD CONSTRAINT FK_2EE162177C3EAC6 FOREIGN KEY (comorbidade_id) REFERENCES comorbidade (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cidadao_comorbidade');
    }
}
