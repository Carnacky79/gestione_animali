<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221229110130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animali (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_cliente_id INTEGER NOT NULL, nome VARCHAR(255) NOT NULL, tipo SMALLINT NOT NULL, razza VARCHAR(255) NOT NULL, taglia VARCHAR(255) NOT NULL, data_nascita DATE NOT NULL, peso DOUBLE PRECISION NOT NULL, sesso SMALLINT NOT NULL, eta INTEGER NOT NULL, comportamento CLOB DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_6B0E90A77BF9CE86 FOREIGN KEY (id_cliente_id) REFERENCES clienti (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6B0E90A77BF9CE86 ON animali (id_cliente_id)');
        $this->addSql('CREATE TABLE clienti (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, cognome VARCHAR(255) NOT NULL, cf VARCHAR(16) DEFAULT NULL, telefono VARCHAR(100) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, foto VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE servizi (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, descrizione CLOB NOT NULL, prezzo DOUBLE PRECISION NOT NULL)');
        $this->addSql('CREATE TABLE servizi_animali (servizi_id INTEGER NOT NULL, animali_id INTEGER NOT NULL, PRIMARY KEY(servizi_id, animali_id), CONSTRAINT FK_99059B0DCA7AE3AD FOREIGN KEY (servizi_id) REFERENCES servizi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_99059B0D2C8F29A3 FOREIGN KEY (animali_id) REFERENCES animali (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_99059B0DCA7AE3AD ON servizi_animali (servizi_id)');
        $this->addSql('CREATE INDEX IDX_99059B0D2C8F29A3 ON servizi_animali (animali_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animali');
        $this->addSql('DROP TABLE clienti');
        $this->addSql('DROP TABLE servizi');
        $this->addSql('DROP TABLE servizi_animali');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
