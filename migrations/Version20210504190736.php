<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210504190736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE heure_projet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, employe_id INTEGER NOT NULL, project_id INTEGER NOT NULL, date DATETIME NOT NULL, duree DOUBLE PRECISION NOT NULL, is_hidden BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_167C49E71B65292 ON heure_projet (employe_id)');
        $this->addSql('CREATE INDEX IDX_167C49E7166D1F9C ON heure_projet (project_id)');
        $this->addSql('DROP INDEX IDX_5C93B3A4B407C362');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects AS SELECT id, type_projet_id, code, date_entree, date_delai, type, description FROM projects');
        $this->addSql('DROP TABLE projects');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_projet_id INTEGER DEFAULT NULL, clients_id INTEGER DEFAULT NULL, code VARCHAR(255) NOT NULL COLLATE BINARY, date_entree DATETIME NOT NULL, date_delai DATETIME DEFAULT NULL, type INTEGER NOT NULL, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_5C93B3A4B407C362 FOREIGN KEY (type_projet_id) REFERENCES type_projet (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5C93B3A4AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO projects (id, type_projet_id, code, date_entree, date_delai, type, description) SELECT id, type_projet_id, code, date_entree, date_delai, type, description FROM __temp__projects');
        $this->addSql('DROP TABLE __temp__projects');
        $this->addSql('CREATE INDEX IDX_5C93B3A4B407C362 ON projects (type_projet_id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A4AB014612 ON projects (clients_id)');
        $this->addSql('DROP INDEX IDX_9B729C4F1EDE0F55');
        $this->addSql('DROP INDEX IDX_9B729C4FA7C41D6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects_option AS SELECT projects_id, option_id FROM projects_option');
        $this->addSql('DROP TABLE projects_option');
        $this->addSql('CREATE TABLE projects_option (projects_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(projects_id, option_id), CONSTRAINT FK_9B729C4F1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9B729C4FA7C41D6F FOREIGN KEY (option_id) REFERENCES option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO projects_option (projects_id, option_id) SELECT projects_id, option_id FROM __temp__projects_option');
        $this->addSql('DROP TABLE __temp__projects_option');
        $this->addSql('CREATE INDEX IDX_9B729C4F1EDE0F55 ON projects_option (projects_id)');
        $this->addSql('CREATE INDEX IDX_9B729C4FA7C41D6F ON projects_option (option_id)');
        $this->addSql('ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD COLUMN email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD COLUMN is_verified BOOLEAN DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE heure_projet');
        $this->addSql('DROP INDEX IDX_5C93B3A4B407C362');
        $this->addSql('DROP INDEX IDX_5C93B3A4AB014612');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects AS SELECT id, type_projet_id, code, date_entree, date_delai, type, description FROM projects');
        $this->addSql('DROP TABLE projects');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_projet_id INTEGER DEFAULT NULL, code VARCHAR(255) NOT NULL, date_entree DATETIME NOT NULL, date_delai DATETIME DEFAULT NULL, type INTEGER NOT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO projects (id, type_projet_id, code, date_entree, date_delai, type, description) SELECT id, type_projet_id, code, date_entree, date_delai, type, description FROM __temp__projects');
        $this->addSql('DROP TABLE __temp__projects');
        $this->addSql('CREATE INDEX IDX_5C93B3A4B407C362 ON projects (type_projet_id)');
        $this->addSql('DROP INDEX IDX_9B729C4F1EDE0F55');
        $this->addSql('DROP INDEX IDX_9B729C4FA7C41D6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects_option AS SELECT projects_id, option_id FROM projects_option');
        $this->addSql('DROP TABLE projects_option');
        $this->addSql('CREATE TABLE projects_option (projects_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(projects_id, option_id))');
        $this->addSql('INSERT INTO projects_option (projects_id, option_id) SELECT projects_id, option_id FROM __temp__projects_option');
        $this->addSql('DROP TABLE __temp__projects_option');
        $this->addSql('CREATE INDEX IDX_9B729C4F1EDE0F55 ON projects_option (projects_id)');
        $this->addSql('CREATE INDEX IDX_9B729C4FA7C41D6F ON projects_option (option_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__users AS SELECT id, username, password FROM users');
        $this->addSql('DROP TABLE users');
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO users (id, username, password) SELECT id, username, password FROM __temp__users');
        $this->addSql('DROP TABLE __temp__users');
    }
}
