<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511112313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidadao ADD data_notificacao DATE NOT NULL, ADD sivep VARCHAR(100) DEFAULT NULL, ADD idade INT NOT NULL, ADD sexo VARCHAR(1) NOT NULL, ADD data_inicio_sintoma DATE NOT NULL, ADD internacao_uti TINYINT(1) NOT NULL, ADD uso_suporte_ventilatorio VARCHAR(1) DEFAULT NULL, ADD raio_x VARCHAR(255) DEFAULT NULL, ADD resultado_exame VARCHAR(1) DEFAULT NULL, ADD evolucao VARCHAR(1) DEFAULT NULL, ADD data_evolucao DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidadao DROP data_notificacao, DROP sivep, DROP idade, DROP sexo, DROP data_inicio_sintoma, DROP internacao_uti, DROP uso_suporte_ventilatorio, DROP raio_x, DROP resultado_exame, DROP evolucao, DROP data_evolucao');
    }
}
