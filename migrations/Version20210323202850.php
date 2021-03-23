<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323202850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE projects_option (projects_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(projects_id, option_id))');
        $this->addSql('CREATE INDEX IDX_9B729C4F1EDE0F55 ON projects_option (projects_id)');
        $this->addSql('CREATE INDEX IDX_9B729C4FA7C41D6F ON projects_option (option_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE option');
        $this->addSql('DROP TABLE projects_option');
    }
}
