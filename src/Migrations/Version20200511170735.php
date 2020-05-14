<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200511170735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_admin (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(150) NOT NULL, nome VARCHAR(255) NOT NULL, status VARCHAR(1) NOT NULL, logradouro VARCHAR(255) NOT NULL, numero VARCHAR(50) DEFAULT NULL, complemento VARCHAR(255) DEFAULT NULL, bairro VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, uf VARCHAR(100) NOT NULL, cep VARCHAR(8) NOT NULL, telefone VARCHAR(10) DEFAULT NULL, celular VARCHAR(11) DEFAULT NULL, data_cadastro DATETIME DEFAULT NULL, cargo VARCHAR(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6ACCF62EAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_pessoa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(180) NOT NULL, cpf VARCHAR(11) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, criado DATETIME DEFAULT NULL, atualizado DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_798DB0BF3E3E11F0 (cpf), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unidade (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cidadao ADD unidade_id INT NOT NULL');
        $this->addSql('ALTER TABLE cidadao ADD CONSTRAINT FK_9D4D3ACEDF4B99B FOREIGN KEY (unidade_id) REFERENCES unidade (id)');
        $this->addSql('CREATE INDEX IDX_9D4D3ACEDF4B99B ON cidadao (unidade_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidadao DROP FOREIGN KEY FK_9D4D3ACEDF4B99B');
        $this->addSql('DROP TABLE user_admin');
        $this->addSql('DROP TABLE user_pessoa');
        $this->addSql('DROP TABLE unidade');
        $this->addSql('DROP INDEX IDX_9D4D3ACEDF4B99B ON cidadao');
        $this->addSql('ALTER TABLE cidadao DROP unidade_id');
    }
}
