<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424094358 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, image, nif FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL COLLATE BINARY, image VARCHAR(100) DEFAULT NULL, name VARCHAR(50) DEFAULT \'-\' NOT NULL, inssnumber BIGINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker (id, image, nif) SELECT id, image, nif FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__worker AS SELECT id, image, nif FROM worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('CREATE TABLE worker (id INTEGER NOT NULL, nif VARCHAR(9) DEFAULT \'-\' NOT NULL, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO worker (id, image, nif) SELECT id, image, nif FROM __temp__worker');
        $this->addSql('DROP TABLE __temp__worker');
    }
}
