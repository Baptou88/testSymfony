<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210321083748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects AS SELECT id, code, date_entree, date_delai, type FROM projects');
        $this->addSql('DROP TABLE projects');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(255) NOT NULL COLLATE BINARY, date_entree DATETIME NOT NULL, date_delai DATETIME DEFAULT NULL, type INTEGER NOT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO projects (id, code, date_entree, date_delai, type) SELECT id, code, date_entree, date_delai, type FROM __temp__projects');
        $this->addSql('DROP TABLE __temp__projects');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__projects AS SELECT id, code, date_entree, date_delai, type FROM projects');
        $this->addSql('DROP TABLE projects');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, code VARCHAR(255) NOT NULL, date_entree DATETIME NOT NULL, date_delai DATETIME DEFAULT NULL, type INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO projects (id, code, date_entree, date_delai, type) SELECT id, code, date_entree, date_delai, type FROM __temp__projects');
        $this->addSql('DROP TABLE __temp__projects');
    }
}
